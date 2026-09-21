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
        $filePath = Storage::path('/public/').$this->url;
        if (!file_exists($filePath)) {
            return 'images/placeholder/no-image.svg';
        }
        $size = getimagesize($filePath);
        $w_orig = $size[0];
        $h_orig = $size[1];
        $pr = $w_orig/$h_orig;
        if (!$w and $h){
            $w = ceil($h*$pr);
        }
        if ($w and !$h){
            $h = ceil($w/$pr);
        }

        if (!file_exists(Storage::path('/public/').'thumbnails/'.$w.'x'.$h.'/'.$this->url)){
            if (!extension_loaded('gd')) {
                return $this->url;
            }
            $save_path= Storage::path('/public/').'thumbnails/'.$w.'x'.$h.'/bb';
            if (!file_exists($save_path)) {
                mkdir($save_path, 0755, true);
            }
            try {
                ImageManager::gd()
                    ->read($filePath)
                    ->cover($w, $h)
                    ->save(Storage::path('/public/').'thumbnails/'.$w.'x'.$h.'/'.$this->url);
            } catch (\Throwable $e) {
                return $this->url;
            }
        }
        return 'thumbnails/'.$w.'x'.$h.'/'.$this->url;
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

