<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\PostStatistic;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class NewsSeed extends Command
{
    protected $signature = 'news:seed {--force : Не спрашивать подтверждение}';
    protected $description = 'Удаляет все новости (Post) и создаёт новые с реальными фото на русском языке в разных категориях. Пользователи НЕ затрагиваются.';

    public function handle()
    {
        // --- БЕЗОПАСНОСТЬ: трогаем ТОЛЬКО посты и их статистику, НЕ пользователей ---
        $oldCount = Post::count();

        if (!$this->option('force') && !$this->confirm("Будет удалено {$oldCount} текущих новостей (пользователи и объявления не затрагиваются). Продолжить?")) {
            $this->warn('Отменено.');
            return 1;
        }

        // Удаляем старые новости и их статистику просмотров.
        // TRUNCATE сбрасывает автоинкремент; временно отключаем проверку FK,
        // т.к. post_statistics ссылается на posts.
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        PostStatistic::truncate();
        Post::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $this->info("Удалено старых новостей: {$oldCount}");

        // Автор — первый админ, иначе первый пользователь. НЕ создаём и не удаляем пользователей.
        $user = User::where('is_admin', 1)->orderBy('id')->first() ?: User::orderBy('id')->first();
        if (!$user) {
            $this->error('В системе нет ни одного пользователя, чтобы назначить автора. Новости не созданы.');
            return 1;
        }

        // Реальные фото с Wikimedia Commons (свободная лицензия) в storage/app/public/news/.
        $photos = [];
        for ($i = 1; $i <= 12; $i++) {
            $rel = 'news/news_' . str_pad((string) $i, 2, '0', STR_PAD_LEFT) . '.jpg';
            if (Storage::disk('public')->exists($rel)) {
                $photos[] = $rel;
            }
        }
        if (empty($photos)) {
            $this->error('Не найдено фото в storage/app/public/news/.');
            return 1;
        }
        $this->info('Доступно фото: ' . count($photos));

        $stories = $this->stories();
        $created = 0;

        foreach ($stories as $i => $story) {
            $image = $photos[$i % count($photos)];

            $post = Post::create([
                'title'        => $story['title'],
                'preview_text' => $story['preview'],
                'content'      => $this->html($story['body']),
                'image'        => $image,
                'category'     => $story['category'],
                'tags'         => $story['tags'],
                'user_id'      => $user->id,
                'active'       => 'Y',
            ]);

            PostStatistic::create([
                'post_id'    => $post->id,
                'user_token' => 'seed-' . $post->id,
                'views'      => $story['views'],
            ]);

            $created++;
        }

        $this->info("Создано новостей: {$created}");

        $byCat = Post::select('category')
            ->selectRaw('count(*) as total')
            ->selectRaw('sum(CASE WHEN image IS NOT NULL AND image <> \'\' THEN 1 ELSE 0 END) as with_image')
            ->groupBy('category')
            ->orderBy('category')
            ->get();

        $this->table(
            ['Категория', 'Всего', 'С фото'],
            $byCat->map(fn ($r) => [$r->category, $r->total, $r->with_image])->toArray()
        );

        $this->info('Всего активных: ' . Post::where('active', 'Y')->count());

        return 0;
    }

    // Обёртываем абзацы в <p> (контент выводится как {!! !!} в шаблоне show).
    private function html(array $paragraphs): string
    {
        $html = '';
        foreach ($paragraphs as $p) {
            $html .= '<p>' . e($p) . '</p>' . "\n";
        }
        return $html;
    }

    // Новости хранятся отдельным файлом-данными, чтобы команда оставалась читаемой.
    private function stories(): array
    {
        return require __DIR__ . '/data/news_stories.php';
    }
}
