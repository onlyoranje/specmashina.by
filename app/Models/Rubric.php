<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kalnoy\Nestedset\NodeTrait;

class Rubric extends Model
{
    use HasFactory;
    use NodeTrait;
    protected $fillable=['title','title_r','parent_id','description', 'level','sort','icon'];
    public function bbs() {
        return $this->hasMany(Bb::class);
    }
    public function rubrics() {
        return $this->hasMany(self::class, 'parent_id');
    }
    public function parent() {
        return $this->belongsTo(self::class, 'parent_id');
    }
    public function level(){
        return $this->belongsTo(self::class,'level');
    }
    public function parameter(){
        return $this->belongsToMany(Parameter::class);
    }
    public function priceType(){
        return $this->belongsToMany(PriceTypeRubric::class);
    }
    public function title(){
        $breadcrumbs= Rubric::ancestorsAndSelf($this->id);
        $parent_rubric = $breadcrumbs[0];
        $title = $parent_rubric->title.' '.$this->title_r;
        if ($this->level==0)$title = $parent_rubric->title.' строительной техники и инструмента';
        return $title;
    }
    public function description(){

        $breadcrumbs= Rubric::ancestorsAndSelf($this->id);
        $parent_rubric = $breadcrumbs[0];
        $description = 'Объявления '.$parent_rubric->title_r.' '.$this->title_r;
        //if ($this->description) $description = $this->description;
        return $description;
    }

    /**
     * Подпись категории в блоке «Категории техники» на главной:
     * первое слово из названия родительской категории («Аренда» / «Продажа»)
     * + название рубрики в родительном падеже (title_r),
     * например «Аренда погрузчика» вместо просто «Погрузчик».
     *
     * Родительский title ожидается выбранным в запросе как parent_title
     * (join в routes/web.php), иначе подтянется через связь parent.
     */
    public function cardTitle(): string
    {
        $parentTitle = $this->parent_title ?? optional($this->parent)->title ?? '';
        $parentWord = explode(' ', trim((string) $parentTitle))[0];

        return trim($parentWord . ' ' . ($this->title_r ?: $this->title));
    }

    /**
     * Счётчик АКТИВНЫХ объявлений рубрики с учётом всех потомков
     * (объявления привязаны к рубрикам 2-го уровня, а карточки категорий
     * на главной и в шапке показывают рубрики 1-го уровня).
     *
     * Числа считает подзапрос: для каждой рубрики-предка суммируются
     * объявления её потомков (связь через вложенные множества _lft/_rgt).
     * Результат доступен как атрибут ads_count (0, если объявлений нет).
     */
    public function scopeWithAdsCount($query)
    {
        $counts = Bb::query()
            ->join('rubrics as descendant', 'bbs.rubric_id', '=', 'descendant.id')
            ->join('status_bbs', function ($join) {
                $join->on('bbs.status_bb_id', '=', 'status_bbs.id')
                     ->where('status_bbs.active', 'Y');
            })
            ->join('rubrics as ancestor', function ($join) {
                $join->on('ancestor._lft', '<=', 'descendant._lft')
                     ->on('ancestor._rgt', '>=', 'descendant._rgt');
            })
            ->select('ancestor.id')
            ->addSelect(DB::raw('COUNT(DISTINCT bbs.id) as ads_count'))
            ->groupBy('ancestor.id');

        return $query
            ->select('rubrics.*') // обязательно до addSelect, иначе затрётся *
            ->leftJoinSub($counts, 'ads_counts', 'ads_counts.id', '=', 'rubrics.id')
            ->addSelect(DB::raw('COALESCE(ads_counts.ads_count, 0) as ads_count'));
    }
}
