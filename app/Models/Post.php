<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['title','content','user_id', 'image','preview_text','category','tags'];
    public function poststatistic(){
        return $this->hasMany(PostStatistic::class);
    }
    /**
     * Возвращает публичный URL-путь к миниатюре заданного размера.
     *
     * Логика (по требованию «сначала проверь — есть ли миниатюра, если нет — создай»):
     *   1. Если оригинал отсутствует → заглушка images/placeholder/no-image.svg.
     *   2. Вычисляет пропорции (если задан только один из размеров).
     *   3. Если миниатюра thumbnails/{w}x{h}/{url} уже есть на диске → сразу
     *      возвращаем её путь (без повторной генерации).
     *   4. Иначе создаём миниатюру (cover-кадрирование) первым доступным движком:
     *      GD → Imagick → ImageMagick CLI (convert/magick). Только если ни один
     *      движок недоступен — вернём оригинал (graceful fallback).
     *
     * @param string $url относительный путь вида "news/xxx.jpg"
     * @param int|null $w  нужная ширина (null — вычислить по пропорции)
     * @param int|null $h  нужная высота (null — вычислить по пропорции)
     * @return string путь, пригодный для Storage::url()
     */
    public function resizeImage($url, $w, $h)
    {
        $publicPath = Storage::path('/public/');
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

        // 4. Миниатюры нет — создаём (cover-кадрирование 600x400 → заполняет кадр)
        $saveDir = dirname($thumbAbs);
        if (!is_dir($saveDir)) {
            @mkdir($saveDir, 0755, true);
        }

        $created = false;

        // 4a. GD
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
                // escapeshellarg-free: бинарники из PATH, безопасно для фиксированных имён
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
    public function count_views(){
        $views = PostStatistic::where('post_id',$this->id)->sum('views');
        return $views;
    }
}
