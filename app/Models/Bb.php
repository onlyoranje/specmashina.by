<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laravel\Scout\Searchable;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request;

class Bb extends Model
{
    use Searchable;

    protected $fillable = ['title', 'content','search_text', 'rubric_id','location_id', 'vendor_id','organization_id','user_id','status_bb_id'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function rubric() {
        return $this->belongsTo(Rubric::class);
    }
    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }
    public function location() {
        return $this->belongsTo(Location::class);
    }
    public function userfile() {
        return $this->hasMany(UserFile::class)->orderBy('sort', 'asc');
    }
    public function bbprice(){
        return $this->hasOne(BbPrice::class);
    }
    public function BbParameters(){
        return $this->hasMany(BbParameters::class);
    }
    public function bbcontact(){
        return $this->hasMany(BbContact::class);
    }
    public function bbstatistic(){
        return $this->hasMany(BbStatistic::class);
    }
    public function searchableAs(): string
    {
        return 'bbs_index';
    }
    public function status_bb() {
    return $this->belongsTo(Status_bb::class);
}
    public function count_views(){
       $views = BbStatistic::where('bb_id',$this->id)->get();
       return $views->count();
    }

    public function toSearchableArray(): array
    {
        $array = $this->toArray();

        // Customize the data array...

        return $array;
    }


}
