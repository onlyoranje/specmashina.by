<?php

namespace Database\Seeders;

use App\Models\Bb;
use App\Models\BbContact;
use App\Models\BbParameters;
use App\Models\BbPrice;
use App\Models\BbStatistic;
use App\Models\ContactType;
use App\Models\Location;
use App\Models\Organization;
use App\Models\PriceType;
use App\Models\Parameter;
use App\Models\Rubric;
use App\Models\Status_bb;
use App\Models\User;
use App\Models\UserFile;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

/**
 * Демо-данные: 20 пользователей с компаниями из разных городов
 * и 100 объявлений с фотографиями из открытых фотостоков.
 *
 * Фото лежат в storage/app/public/bb/stock-*.jpg; если пула нет —
 * скачиваются по манифесту database/seeders/demo_stock_photos.tsv
 * (Openverse → Flickr/другие открытые стоки).
 *
 * Идемпотентно: демо-пользователи (email на @demo.specmashina.by)
 * удаляются каскадно (организации, объявления, файлы) и создаются заново.
 */
class DemoListingsSeeder extends Seeder
{
    /** Количество компаний (пользователей) из разных городов. */
    private const COMPANIES = 20;

    /** Количество объявлений. */
    private const LISTINGS = 100;

    private const DEMO_DOMAIN = 'demo.specmashina.by';
    private const DEMO_PASSWORD = '12345678';

    private const ORG_PREFIXES = [
        'СпецТехРента', 'СтройМашСервис', 'ТехноПрокат', 'АгрегатСервис', 'ПромТранс',
        'СтройПоставка', 'МашиноПрокат', 'ТехноСтрой', 'СпецМашГрупп', 'АвтоЛогистик',
    ];

    private const STREETS = ['Советская', 'Ленина', 'Мира', 'Победителей', 'Строителей', 'Заводская', 'Школьная', 'Набережная'];

    private const FIRST_NAMES = ['Алексей', 'Дмитрий', 'Сергей', 'Андрей', 'Владимир', 'Игорь', 'Павел', 'Максим', 'Олег', 'Никита'];

    private const LAST_NAMES = ['Иванов', 'Петров', 'Сидоров', 'Кузнецов', 'Смирнов', 'Волков', 'Новиков', 'Морозов', 'Орлов', 'Фролов'];

    /** Условные «модели» для правдоподобных заголовков. */
    private const MODELS = ['200', '320', '320D', 'D65', 'GR215', '966', 'T-170', 'K-700', 'PC200', 'ZX200', 'GR135', '815F', 'S1500', 'JCB 3CX', 'MK-290'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Детерминированность случайных значений (стабильные прогоны)
        mt_srand(20261005);

        $this->cleanup();

        $pool = $this->photoPool();
        if (count($pool) === 0 && $this->command) {
            $this->command->warn('Пул фотографий пуст — объявления будут без фото.');
        }

        $cities     = Location::where('level', 1)->orderBy('id')->get();
        $leaves     = Rubric::whereDoesntHave('rubrics')->with('parent.parent')->get()->shuffle();
        $vendors    = Vendor::all();
        $statuses   = Status_bb::whereIn('status', ['S', 'P7', 'P15'])->get()->keyBy('status');
        $priceTypes = PriceType::all();
        $contactTypes = ContactType::all()->keyBy('id');

        if ($cities->count() < self::COMPANIES || $leaves->count() === 0 || $vendors->count() === 0) {
            if ($this->command) $this->command->error('Недостаточно справочных данных (города/рубрики/бренды).');
            return;
        }

        $companies = $this->createCompanies($cities);

        for ($i = 0; $i < self::LISTINGS; $i++) {
            $this->createListing($i, $leaves[$i % $leaves->count()], $vendors, $companies[$i % count($companies)], $statuses, $priceTypes, $contactTypes, $pool);
        }

        if ($this->command) {
            $this->command->info(sprintf(
                'Готово: компаний=%d, объявлений=%d, фото в пуле=%d.',
                count($companies),
                Bb::whereIn('user_id', User::where('email', 'like', '%@' . self::DEMO_DOMAIN)->pluck('id'))->count(),
                count($pool)
            ));
        }
    }

    /**
     * Удаляет прошлые демо-данные: пользователи каскадно тянут
     * организации (FK user_id) и объявления (FK user_id),
     * объявления — bb_prices, bb_parameters, bb_contacts, user_files, статистику.
     */
    private function cleanup(): void
    {
        $users = User::where('email', 'like', '%@' . self::DEMO_DOMAIN)->get();
        if ($users->isEmpty()) return;

        $bbIds = Bb::whereIn('user_id', $users->pluck('id'))->pluck('id');

        // FK в bb_parameters/bb_contacts/bb_statistics созданы без
        // ON DELETE CASCADE — удаляем зависимые строки объявляем явно,
        // затем сами объявления и пользователей (организации — каскадом).
        BbParameters::whereIn('bb_id', $bbIds)->delete();
        BbContact::whereIn('bb_id', $bbIds)->delete();
        BbStatistic::whereIn('bb_id', $bbIds)->delete();
        BbPrice::whereIn('bb_id', $bbIds)->delete();
        UserFile::whereIn('bb_id', $bbIds)->delete();
        Bb::whereIn('id', $bbIds)->delete();

        $users->each(fn (User $user) => $user->delete());
    }

    /**
     * Создаёт компании: по одному пользователю и организации на город,
     * города равномерно распределены по списку level 1 (города).
     *
     * @return array<int, array{user: User, org: Organization, city: Location, person: string}>
     */
    private function createCompanies($cities): array
    {
        $companies = [];
        $step = intdiv($cities->count(), self::COMPANIES);
        $usedUnp = [];

        for ($i = 0; $i < self::COMPANIES; $i++) {
            $city = $cities[$i * $step];
            $first = self::FIRST_NAMES[$i % count(self::FIRST_NAMES)];
            $last  = self::LAST_NAMES[($i * 3) % count(self::LAST_NAMES)];
            $phone = $this->phone();
            $slug  = 'demo' . ($i + 1);

            do {
                $unp = (string) mt_rand(100000000, 999999999);
            } while (isset($usedUnp[$unp]));
            $usedUnp[$unp] = true;

            $user = User::create([
                'name'     => 'demo_partner_' . ($i + 1),
                'realname' => $first . ' ' . $last,
                'email'    => $slug . '@' . self::DEMO_DOMAIN,
                'phone'    => $phone,
                'password' => Hash::make(self::DEMO_PASSWORD),
            ]);

            $orgTitle = self::ORG_PREFIXES[$i % count(self::ORG_PREFIXES)] . ' ' . $city->title;
            $org = Organization::create([
                'title'       => $orgTitle,
                'location_id' => $city->id,
                'address'     => 'ул. ' . self::STREETS[$i % count(self::STREETS)] . ', д. ' . mt_rand(1, 120),
                'unp'         => $unp,
                'email'       => $slug . '@' . self::DEMO_DOMAIN,
                'phone'       => $phone,
                'content'     => 'Компания «' . $orgTitle . '» — аренда и продажа строительной техники в г. ' . $city->title . '. Работаем по договору, выезд на объект по городу и области.',
                'user_id'     => $user->id,
                'active'      => 'Y',
            ]);
            $org->forceFill(['approve' => 'Y'])->save();
            $user->forceFill(['organization_id' => $org->id])->save();

            $companies[] = ['user' => $user, 'org' => $org, 'city' => $city, 'person' => $first . ' ' . $last];
        }

        return $companies;
    }

    /**
     * Создаёт одно объявление со всеми связями:
     * цена, характеристики (по параметрам листовой рубрики), контакты,
     * фотографии из пула, статистика просмотров, search_text.
     */
    private function createListing(int $i, $leaf, $vendors, array $company, $statuses, $priceTypes, $contactTypes, array $pool): void
    {
        $vendor  = $vendors[mt_rand(0, $vendors->count() - 1)];
        $root    = $leaf->parent->parent;                       // «Аренда» / «Продажа»
        $isRent  = $root && $root->title === 'Аренда';
        $city    = $company['city'];
        $model   = self::MODELS[mt_rand(0, count(self::MODELS) - 1)];
        $title   = mb_substr(trim($leaf->title . ' ' . $vendor->name . ' ' . $model), 0, 50);

        // Статус: 85% «Стандарт», 10% «Премиум 7», 5% «Премиум 15»
        $r = mt_rand(1, 100);
        $statusKey = $r <= 85 ? 'S' : ($r <= 95 ? 'P7' : 'P15');
        $status = $statuses[$statusKey];
        $createdAt = now()->subDays(mt_rand(1, 120))->subHours(mt_rand(0, 23))->subMinutes(mt_rand(0, 59));
        $premiumUntil = $statusKey === 'S'
            ? null
            : now()->addDays($statusKey === 'P7' ? 7 : 15)->subDays(mt_rand(0, 6));

        // Характеристики: заполняем ~85% параметров рубрики
        $paramValues = [];
        foreach ($leaf->parameter as $param) {
            if (mt_rand(1, 100) <= 15) continue;
            $value = $this->paramValue($param);
            if ($value !== null) $paramValues[$param->id] = $value;
        }

        $yearParam = $leaf->parameter->firstWhere('name', 'Год выпуска');
        $year = $yearParam ? ($paramValues[$yearParam->id] ?? null) : null;
        $action = $isRent ? 'в аренду' : 'в продажу';

        $content = sprintf(
            '%s %s %s %s в г. %s. Техника в исправном состоянии, готова к работе на объекте.%s Доставка по городу и области. Оплата по договору — для юрлиц и физлиц.',
            $leaf->title,
            $vendor->name,
            $model,
            $action,
            $city->title,
            $year ? ' Год выпуска: ' . $year . '.' : ''
        );

        $bb = Bb::create([
            'title'           => $title,
            'content'         => $content,
            'search_text'     => $this->searchText($leaf, $vendor, $company, $title),
            'rubric_id'       => $leaf->id,
            'location_id'     => $city->id,
            'vendor_id'       => $vendor->id,
            'organization_id' => $company['org']->id,
            'user_id'         => $company['user']->id,
            'status_bb_id'    => $status->id,
            'active'          => $status->active,
            'lifted_at'       => $createdAt,
        ]);
        $bb->forceFill([
            'created_at'    => $createdAt,
            'updated_at'    => $createdAt,
            'premium_until' => $premiumUntil,
        ])->save();

        // Цена: аренда — суточные ставки, продажа — покупная стоимость (BYN)
        $priceType = $priceTypes[mt_rand(0, $priceTypes->count() - 1)];
        BbPrice::create([
            'bb_id'         => $bb->id,
            'price_type_id' => $priceType->id,
            'price'         => $isRent ? mt_rand(5, 55) * 10 : mt_rand(3, 160) * 1000,
        ]);

        // Характеристики
        foreach ($paramValues as $parameterId => $value) {
            BbParameters::create(['bb_id' => $bb->id, 'parameter_id' => $parameterId, 'value' => $value]);
        }

        // Контакты: телефон + контактное лицо
        BbContact::create(['bb_id' => $bb->id, 'contact_type_id' => 1, 'value' => $this->phone()]);
        BbContact::create(['bb_id' => $bb->id, 'contact_type_id' => 2, 'value' => $company['person']]);

        // Просмотры
        BbStatistic::create(['bb_id' => $bb->id, 'views' => mt_rand(3, 950)]);

        // Фотографии (1–3 из пула, сдвинутое окно — фото встречается не подряд)
        $photoCount = count($pool) > 0 ? mt_rand(1, min(3, count($pool))) : 0;
        for ($j = 0; $j < $photoCount; $j++) {
            $file = $pool[($i * 5 + $j * 17) % count($pool)];
            UserFile::create([
                'bb_id'         => $bb->id,
                'url'           => 'bb/' . $file,
                'sort'          => $j + 1,
                'type'          => 'jpg',
                'size'          => (int) @filesize(Storage::path('public/bb/' . $file)),
                'original_name' => str_replace('stock-', 'photo-', $file),
            ]);
        }
    }

    /** Правдоподобное значение характеристики по её типу/мере. */
    private function paramValue(Parameter $p): ?string
    {
        switch ($p->name) {
            case 'Год выпуска':
                return (string) mt_rand(2008, 2025);
            case 'Мощность':
                return $p->measure === 'Вт' ? (string) (mt_rand(6, 35) * 100) : (string) mt_rand(30, 450);
            case 'Масса':
                return number_format(mt_rand(12, 400) / 10, 1, '.', '');
            case 'Глубина копания':
                return number_format(mt_rand(20, 90) / 10, 1, '.', '');
            case 'Объем ковша':
                return number_format(mt_rand(3, 35) / 10, 1, '.', '');
            case 'Объем кузова':
                return (string) mt_rand(5, 40);
            case 'Грузоподъемность':
                return $p->measure === 'кг' ? (string) mt_rand(200, 2500) : (string) mt_rand(1, 60);
            case 'Высота подъема':
            case 'Рабочая высота':
                return (string) mt_rand(3, 50);
            case 'Вылет стрелы':
                return (string) mt_rand(5, 45);
            case 'Производительность':
                return (string) mt_rand(8, 150);
            case 'Длина платформы':
                return (string) mt_rand(4, 20);
            case 'Напряжение':
                return mt_rand(0, 1) ? '380' : '220';
        }
        if ($p->type === 'number') {
            $min = $p->min ?? 0;
            $max = $p->max ?? ($min + 1000);
            return (string) mt_rand((int) $min, (int) $max);
        }
        return null;
    }

    /** search_text — по образцу Bb::search_index(): заголовок, бренд, рубрики, города, организация. */
    private function searchText($leaf, $vendor, array $company, string $title): string
    {
        $text = [$title, $vendor->name];
        foreach (Rubric::whereAncestorOrSelf($leaf->id)->get() as $r) $text[] = $r->title;
        foreach (Location::whereAncestorOrSelf($company['city']->id)->get() as $l) $text[] = $l->title;
        $text[] = $company['org']->title;
        return implode(' ', $text);
    }

    /** Телефон в формате маски contact_type=1: +375 XX XXX-XX-XX. */
    private function phone(): string
    {
        $prefix = ['29', '33', '25', '44', '17'][mt_rand(0, 4)];
        return '+375 ' . $prefix . ' ' . mt_rand(100, 999) . '-' . mt_rand(10, 99) . '-' . mt_rand(10, 99);
    }

    /**
     * Пул фотографий: файлы storage/app/public/bb/stock-*.jpg.
     * Если пула нет — скачивает изображения по манифесту (открытые стоки).
     */
    private function photoPool(): array
    {
        $dir = Storage::path('public/bb');
        if (!is_dir($dir)) mkdir($dir, 0755, true);

        $files = glob($dir . '/stock-*.jpg') ?: [];
        if (count($files) === 0) $this->downloadStock($dir);
        $files = glob($dir . '/stock-*.jpg') ?: [];

        return array_map('basename', $files);
    }

    /** Скачивает фото по манифесту URL (database/seeders/demo_stock_photos.tsv). */
    private function downloadStock(string $dir): void
    {
        $manifest = database_path('seeders/demo_stock_photos.tsv');
        if (!is_file($manifest)) return;

        $n = 0;
        foreach (file($manifest, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
            if ($n >= 60) break;
            $url = trim(explode("\t", $line)[0]);
            if ($url === '' || str_starts_with($url, '#')) continue;
            try {
                $response = Http::withHeaders(['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36'])
                    ->timeout(20)
                    ->get($url);
                if (!$response->successful()) continue;
                $body = $response->body();
                if (strlen($body) < 15000) continue;
                if (!str_starts_with((string) $response->header('content-type'), 'image/')) continue;
                $n++;
                file_put_contents($dir . '/stock-' . sprintf('%03d', $n) . '.jpg', $body);
            } catch (\Throwable $e) {
                continue;
            }
        }
    }
}
