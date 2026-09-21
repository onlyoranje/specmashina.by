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
    public function resizeImage($url,$w,$h)
    {
        $filePath = Storage::path('/public/').$url;
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

        if (!file_exists(Storage::path('/public/').'thumbnails/'.$w.'x'.$h.'/'.$url)){
            if (!extension_loaded('gd')) {
                return $url;
            }
            $save_path= Storage::path('/public/').'thumbnails/'.$w.'x'.$h.'/';
            if (!file_exists($save_path)) {
                mkdir($save_path, 0755, true);
            }
            try {
                ImageManager::gd()
                    ->read($filePath)
                    ->cover($w, $h)
                    ->save(Storage::path('/public/').'thumbnails/'.$w.'x'.$h.'/'.$url);
            } catch (\Throwable $e) {
                return $url;
            }
        }
        return 'thumbnails/'.$w.'x'.$h.'/'.$url;
    }
    public function count_views(){
        $views = PostStatistic::where('post_id',$this->id)->sum('views');
        return $views;
    }
}
