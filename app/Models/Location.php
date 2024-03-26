<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Location extends Model
{
    use HasFactory;
    use NodeTrait;
    protected $fillable=['title','title_r','parent_id', 'level','sort','lat','lng','image'];
    public function bbs()
    {
        return $this->hasMany(Bb::class);
    }

    public function locations() {
        return $this->hasMany(self::class, 'parent_id');
    }
    public function parent() {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function level(){
        return $this->belongsTo(self::class,'level');
    }
    public function resizeImage($url,$w,$h)
    {
        $size = getimagesize(Storage::path('/public/').$url);
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
            $save_path= Storage::path('/public/').'thumbnails/'.$w.'x'.$h.'/';
            if (!file_exists($save_path)) {
                mkdir($save_path, 755, true);
            }
            //$thumbnail = Image::make(Storage::path('/public/').$this->$url);
            $thumbnail = Image::make(Storage::path('/public/').$url);
            $thumbnail->fit($w, $h);
            $thumbnail->save(Storage::path('/public/').'thumbnails/'.$w.'x'.$h.'/'.$url);
        }
        return 'thumbnails/'.$w.'x'.$h.'/'.$url;
    }
}
