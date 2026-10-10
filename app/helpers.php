<?php

use App\Models\Location;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

function timesince($datetime)
{
    $targetTime = strtotime($datetime);
    $currentTime = strtotime("now");
    $interval =  $currentTime-$targetTime;
    switch ($interval){
        //секунды
        case($interval<60 and substr($interval,-1)==1 and $interval!==11):return $interval." секунду назад";
        case($interval<60 and substr($interval,-1)<4 and substr($interval,-1)>1):return $interval." секунды назад";
        case($interval<60): return $interval." секунд назад";
        // минуты
        case($interval<60*60 and substr(floor($interval/60),-1)==1 and floor($interval/60)!==11):return floor($interval/60)." минуту назад";
        case($interval<60*60 and substr(floor($interval/60),-1)<4 and substr($interval/60,-1)>1):return floor($interval/60)." минуты назад";
        case($interval<60*60 and $interval>59): return floor($interval/60)." минут назад";
        //часы
        case($interval<60*60*24 and substr(floor($interval/(60*60)),-1)==1 and floor($interval/(60*60))!==11):return floor($interval/(60*60))." час назад";
        case($interval<60*60*24 and substr(floor($interval/(60*60)),-1)<4 and substr(floor($interval/(60*60)),-1)>1):return floor($interval/(60*60))." часа назад";
        case($interval<60*60*24 and $interval>=60*60): return floor($interval/(60*60))." часов назад";
        // дни
        case($interval<60*60*24*30 and substr(floor($interval/(60*60*24)),-1)==1 and floor($interval/(60*60*24))!==11):return floor($interval/(60*60*24))." день назад";
        case($interval<60*60*24*30 and substr(floor($interval/(60*60*24)),-1)<4 and substr(floor($interval/(60*60*24)),-1)>1):return floor($interval/(60*60*24))." дня назад";
        case($interval<60*60*24*30 and $interval>=60*60*24): return floor($interval/(60*60*24))." дней назад";
        //Месяцы
        case($interval<60*60*24*30*12 and substr(floor($interval/(60*60*24*30)),-1)==1 and floor($interval/(60*60*24*30))!==11):return floor($interval/(60*60*24*30))." месяц назад";
        case($interval<60*60*24*30*12 and substr(floor($interval/(60*60*24*30)),-1)<4 and substr(floor($interval/(60*60*24*30)),-1)>1):return floor($interval/(60*60*24*30))." месяца назад";
        case($interval<60*60*24*30*12 and $interval>=60*60*24*30): return floor($interval/(60*60*24*30))." месяцев назад";
        //годы
        case(substr(floor($interval/(60*60*24*30*12)),-1)==1 and floor($interval/(60*60*24*30*12))!==11):return floor($interval/(60*60*24*30*12))." год назад";
        case(substr(floor($interval/(60*60*24*30*12)),-1)<4 and substr(floor($interval/(60*60*24*30*12)),-1)>1):return floor($interval/(60*60*24*30*12))." года назад";
        case($interval>=60*60*24*30*12): return floor($interval/(60*60*24*30*12))." лет назад";
        //default: return $interval." секунд назад";




    }


}
function url_parameters($request){
    $lkl = $request->toArray();
    if ($request)
    {
        $result ='?';

        foreach ($lkl as $key=>$value) {
            $result.=$key.'='.$value;
        }

    }
    return $result;
}
function FakeImage($width=640,$height=480,$blur=0,$grayscale=0,$title='Аренда и продажа техники в Беларуси',$img='image.jpg'){
 $image = '<img src="/storage/'.$img.'" alt="'.$title.'" style="filter: blur('.$blur.'px)  grayscale('.$grayscale.'%); -o-object-fit:cover; object-fit:cover;">';
 return $image;
}
function get_dir_files( $dir, $recursive = true, $include_folders = false ){
    if( ! is_dir($dir) )
        return array();

    $files = array();

    $dir = rtrim( $dir, '/\\' ); // удалим слэш на конце

    foreach( glob( "$dir/{,.}[!.,!..]*", GLOB_BRACE ) as $file ){

        if( is_dir( $file ) ){
            if( $include_folders )
                $files[] = $file;
            if( $recursive )
                $files = array_merge( $files, call_user_func( __FUNCTION__, $file, $recursive, $include_folders ) );
        }
        else
            $files[] = $file;
    }

    return $files;
}
function Distance(Location $location1,Location $location2){
    $theta = $location1->lng - $location2->lng;
    $distance = (sin(deg2rad($location1->lat)) * sin(deg2rad($location2->lat))) + (cos(deg2rad($location1->lat)) * cos(deg2rad($location2->lat)) * cos(deg2rad($theta)));
    $distance = acos($distance);
    $distance = rad2deg($distance);
    $distance = $distance * 60 * 1.1515 * 1.609344;
    return ceil($distance);
}
function systemEmailSend($body){
    $from='info@landi.by';
    $to_name = 'Admin';
    $to_email = '47@terwa.by';
    $data = array('name'=>$to_name, "body" => $body);
    Mail::send('emails', $data, function($message) use ($to_name, $to_email,$from) {

        $message->to($to_email, $to_name)->subject("Служебное уведомление");
        $message->from($from,'Landi.by');
    });
}
function bbs_count_title($bbs){
    switch ($bbs){
        case 0: return 'Ваше объявление будет первым!';
        case 1: return $bbs.' объявление';
        case ($bbs>1 and $bbs<5): return $bbs.' объявления';
        case ($bbs>4 and $bbs<21): return $bbs.' объявлений';
        case ($bbs>20 and substr($bbs,-1)==1): return $bbs.' объявление';
        case ($bbs>20 and substr($bbs,-1)==2): return $bbs.' объявления';
        case ($bbs>20 and substr($bbs,-1)==3): return $bbs.' объявления';
        case ($bbs>20 and substr($bbs,-1)==4): return $bbs.' объявления';
        default: return $bbs.' объявлений';
    }
}

if (! function_exists('resizeImage')) {
    /**
     * Возвращает ГОТОВЫЙ публичный URL уменьшённой копии изображения.
     *
     * Универсальная замена «ручного» вывода путей вида
     * Storage::url($img->resize($w, $h)). В отличие от методов моделей
     * (Post/Location/User::resizeImage и UserFile::resize), которые отдают
     * ОТНОСИТЕЛЬНЫЙ путь и требуют внешней обёртки Storage::url(), этот
     * хелпер сразу возвращает абсолютный URL, пригодный для атрибута src.
     *
     * Логика (принцип «сначала проверь — есть ли миниатюра, если нет — создай»):
     *   1. Пустой путь или отсутствующий оригинал → заглушка
     *      public/images/placeholder/no-image.svg (через asset()).
     *   2. Доопределяем пропорции, если задан только один из размеров.
     *   3. Миниатюра thumbnails/{w}x{h}/{url} уже на диске → сразу её URL.
     *   4. Иначе создаём cover-кадрирование первым доступным движком:
     *      GD → Imagick → ImageMagick CLI. Нет ни одного — оригинал (fallback).
     *
     * @param string      $url относительный путь в публичном диске («bbs/xx.jpg»)
     * @param int|null    $w   нужная ширина  (null — вычислить по пропорции)
     * @param int|null    $h   нужная высота  (null — вычислить по пропорции)
     * @return string готовая ссылка для src (абсолютный URL)
     */
    function resizeImage($url, $w = null, $h = null)
    {
        // Пустой источник — сразу статичная заглушка из public/
        if (empty($url) || ! is_string($url)) {
            return asset('images/placeholder/no-image.svg');
        }

        $rel        = ltrim($url, '/');
        $disk       = Storage::disk('public');
        $publicPath = $disk->path('');
        $filePath   = $publicPath . $rel;

        // 1. Нет оригинала — отдаём заглушку
        if (! is_file($filePath)) {
            return asset('images/placeholder/no-image.svg');
        }

        // 2. Пропорции: доопределяем отсутствующий размер
        $size = @getimagesize($filePath);
        if (! $size) {
            return $disk->url($rel);           // файл есть, но не изображение
        }
        [$w_orig, $h_orig] = $size;
        $pr = $w_orig / max(1, $h_orig);
        if (! $w && $h) { $w = (int) ceil($h * $pr); }
        if ($w && ! $h) { $h = (int) ceil($w / $pr); }
        $w = (int) $w;
        $h = (int) $h;

        // 3. Миниатюра уже сгенерирована ранее — сразу её и возвращаем
        $thumbRelative = 'thumbnails/' . $w . 'x' . $h . '/' . $rel;
        $thumbAbs      = $publicPath . $thumbRelative;
        if (is_file($thumbAbs)) {
            return $disk->url($thumbRelative);
        }

        // 4. Миниатюры нет — создаём (cover-кадрирование: заполняет кадр)
        $saveDir = dirname($thumbAbs);
        if (! is_dir($saveDir)) {
            @mkdir($saveDir, 0755, true);
        }

        $created = false;

        // 4a. GD (драйвер Intervention)
        if (! $created && extension_loaded('gd')) {
            try {
                \Intervention\Image\ImageManager::gd()
                    ->read($filePath)
                    ->cover($w, $h)
                    ->save($thumbAbs);
                $created = true;
            } catch (\Throwable $e) {
                $created = false;
            }
        }

        // 4b. Imagick (драйвер Intervention, если установлен пакет)
        if (! $created && class_exists(\Imagick::class)) {
            try {
                \Intervention\Image\ImageManager::imagick()
                    ->read($filePath)
                    ->cover($w, $h)
                    ->save($thumbAbs);
                $created = true;
            } catch (\Throwable $e) {
                $created = false;
            }
        }

        // 4c. ImageMagick CLI (convert/magick) — эмуляция cover():
        //     масштаб с заполнением кадра (^) + центральная обрезка (gravity/extent)
        if (! $created) {
            $bin = null;
            foreach (['convert', 'magick'] as $candidate) {
                $which = trim((string) @shell_exec('command -v ' . $candidate . ' 2>/dev/null'));
                if ($which !== '') { $bin = $which; break; }
            }
            if ($bin !== null) {
                $cmd = sprintf(
                    '%s %s -resize %dx%d^ -gravity center -extent %dx%d -quality 82 -strip %s 2>/dev/null',
                    escapeshellcmd($bin),
                    escapeshellarg($filePath),
                    $w, $h, $w, $h,
                    escapeshellarg($thumbAbs)
                );
                @shell_exec($cmd);
                $created = is_file($thumbAbs);
            }
        }

        // 5. Успех — URL миниатюры; иначе (нет ни одного движка) — оригинал
        return $created ? $disk->url($thumbRelative) : $disk->url($rel);
    }
}

if (! function_exists('current_path')) {
    /**
     * Текущий путь сайта от корня — без схемы и хоста («/rent»).
     *
     * Такие ссылки не зависят от имени сайта: корректны и при прямом
     * обращении по LAN-IP, и через HTTPS-прокси роутера, и при смене домена
     * (request()->url() возвращает абсолютный адрес запроса — при
     * проксировании это http://<LAN-IP>/… → Mixed Content).
     */
    function current_path(): string
    {
        return '/'.ltrim(request()->path(), '/');
    }
}

if (! function_exists('current_url')) {
    /**
     * Текущий путь с query-строкой, тоже без схемы и хоста
     * («/rent?sort=price») — для ссылок и history.pushState().
     */
    function current_url(): string
    {
        $query = request()->getQueryString();

        return current_path().($query !== '' ? '?'.$query : '');
    }
}

