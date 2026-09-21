<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
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
    public function parent_location(){
        $parent = Location::where('id',$this->parent_id)->first();
        return $parent;
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
}
