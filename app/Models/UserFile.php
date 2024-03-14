<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\Facades\Image;

class UserFile extends Model
{
    use HasFactory;
    protected $fillable=['url','bb_id','size','sort','type','original_name'];



    public function bb(){
        return $this->belongsTo(Bb::class);
    }
    public function resize($w,$h)
    {
        $size = getimagesize(Storage::path('/public/').$this->url);
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
            $save_path= Storage::path('/public/').'thumbnails/'.$w.'x'.$h.'/';
            if (!file_exists($save_path)) {
                mkdir($save_path, 755, true);
            }
            $thumbnail = Image::make(Storage::path('/public/').$this->url);
            $thumbnail->fit($w, $h);
            $thumbnail->save(Storage::path('/public/').'thumbnails/'.$w.'x'.$h.'/'.$this->url);
        }
        return 'thumbnails/'.$w.'x'.$h.'/'.$this->url;
    }
    public function resizeClass()
    {
        $size = getimagesize(Storage::path('/public/').$this->url);
        $w = $size[0];
        $h = $size[1];
        if ($w>=$h){
            $class = 'width: 100%; height: auto';
        }
        if ($w<$h){
            $class = 'width: auto ;height: 100%';
        }
        return $class;
    }
}

