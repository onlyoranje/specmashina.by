<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laravel\Scout\Searchable;
use App\Models\User;
use Maize\Markable\Markable;
use Maize\Markable\Models\Bookmark;
use Maize\Markable\Models\Like;
use Symfony\Component\HttpFoundation\Request;

class Bb extends Model
{
    use Searchable;
    use Markable;

    protected $fillable = ['title', 'content','search_text', 'rubric_id','location_id', 'vendor_id','organization_id','user_id','status_bb_id','active'];
    protected static $marks = [
        Bookmark::class,
    ];
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
       $views = BbStatistic::where('bb_id',$this->id)->sum('views');
       return $views;
    }

    public function toSearchableArray(): array
    {
        $array = $this->toArray();

        // Customize the data array...

        return $array;
    }
    public function admin_comment(){
        return $this->hasMany(BbAdminComments::class);
    }
public function title(){
    $title =$this->parent_rubric()->title." ".$this->rubric->title_r." ".$this->vendor->name." ".$this->title;
    return $title;
}
public function parent_rubric(){
    $parent_rubrics = Rubric::whereAncestorOrSelf($this->rubric_id)->orderBy('level')->get();
    $parent_rubric = $parent_rubrics[0];

    return $parent_rubric;
}
    public function subparent_rubric(){
        $parent_rubrics = Rubric::whereAncestorOrSelf($this->rubric_id)->orderBy('level')->get();
        $subparent_rubric = $parent_rubrics[1];
        return $subparent_rubric;
    }
    public function images(){
        $images = UserFile::where('bb_id',$this->id)->orderBy('sort')->get();
        return $images;
    }
    public function like(){
        if (Auth::user()){
            if (Bookmark::has($this, Auth::user())) {
                echo  "<li class='like' data-bb-id='".$this->id."' data-bookmark='true'><a><i class='fa-solid fa-bookmark'></i></a></li>";
            }else {
                echo "<li class='like' data-bb-id='".$this->id."' data-bookmark='false'><a><i class='fa-regular fa-bookmark'></i></a></li>";

            }
        } else {
            echo "<li class='like_u' data-bb-id='".$this->id."' data-bookmark='false'  data-bs-toggle='tooltip' data-bs-placement='bottom' title='Tooltip on bottom'><a><i class='fa-regular fa-bookmark'></i></a></li>";
        }

    }
    public function edit_status($status_bb){
        $status = Status_bb::where('status',$status_bb)->get()->first;

        $this->fill(['status_bb_id'=>$status->id]);
        $this->save();
    }
}
