<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManager;

class UserFile extends Model
{
    use HasFactory;
    protected $fillable=['url','bb_id','size','sort','type','original_name'];



    public function bb(){
        return $this->belongsTo(Bb::class);
    }
    public function resize($w,$h)
    {
        $publicPath = Storage::path('/public/');
        $url = $this->url;
        $filePath = $publicPath . $url;

        // 1. Нет оригинала — отдаём заглушку
        if (!is_file($filePath)) {
            return 'images/placeholder/no-image.svg';
        }

        // 2. Пропорции: доопределяем отсутствующий размер
        $size = @getimagesize($filePath);
        if (!$size) {
            return $url; // файл есть, но не изображение — отдаём как есть
        }
        [$w_orig, $h_orig] = $size;
        $pr = $w_orig / max(1, $h_orig);
        if (!$w && $h) { $w = (int) ceil($h * $pr); }
        if ($w && !$h) { $h = (int) ceil($w / $pr); }
        $w = (int) $w;
        $h = (int) $h;

        // 3. Миниатюра уже сгенерирована ранее — сразу её и возвращаем
        $thumbRelative = 'thumbnails/' . $w . 'x' . $h . '/' . $url;
        $thumbAbs = $publicPath . $thumbRelative;
        if (is_file($thumbAbs)) {
            return $thumbRelative;
        }

        // 4. Миниатюры нет — создаём (cover-кадрирование 480x360 → заполняет кадр)
        $saveDir = dirname($thumbAbs);
        if (!is_dir($saveDir)) {
            @mkdir($saveDir, 0755, true);
        }

        $created = false;

        // 4a. GD (драйвер Intervention)
        if (!$created && extension_loaded('gd')) {
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
        if (!$created && class_exists(\Imagick::class)) {
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
        if (!$created) {
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

        // 5. Успех — путь к миниатюре; иначе (нет ни одного движка) — оригинал
        return $created ? $thumbRelative : $url;
    }
    public function resizeClass()
    {
        $filePath = Storage::path('/public/').$this->url;
        if (!file_exists($filePath)) {
            return 'width: 100%; height: auto';
        }
        $size = getimagesize($filePath);
        $w = $size[0];
        $h = $size[1];
        if ($w>$h){
            $class = 'width: 100%; height: auto';
        }
        if ($w<=$h){
            $class = 'width: auto ;height: 100%';
        }
        return $class;
    }
}

