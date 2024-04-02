<?php

namespace App\Http\Controllers;

use App\Models\Bb;
use App\Models\BbStatistic;
use App\Models\Location;
use App\Models\Rubric;
use App\Models\UserFile;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class BbsController extends Controller
{
    public function index() {

        $context = [
            'bbs_last' => Bb::orderBy('created_at','desc')->limit(8)->get(),
            'bbs_random' => Bb::inRandomOrder()->limit(8)->get(),
            'bbs_actual' => Bb::orderBy('lifted_at','desc')->orderBy('updated_at','desc')->limit(6)->get(),
            'bbs_popular' => Bb::addSelect(['bbstatistic_count' => BbStatistic::selectRaw('sum(views) as total')
                ->whereColumn('bb_id', 'bbs.id')
                ->groupBy('bb_id')
            ])->orderBy('bbstatistic_count','desc')->limit(8)->get(),
            'rubrics'=>Rubric::orderBy('sort')->orderBy('title')->get()->toTree(),
            'rubrics_slider'=>Rubric::withCount('bbs')->where('level',2)->orderBy('bbs_count','desc')->limit(12)->inRandomOrder()->get(),
            'bbs_city'=>Location::withCount('bbs')->where('level',1)->orderBy('bbs_count','desc')->limit(5)->inRandomOrder()->get()

        ];
        return view('home', $context);
    }
    public function detail(Bb $bb,Request $request) {
//dd($request);
        $stat = BbStatistic::updateOrCreate(['bb_id'=>$bb->id,'user_token'=> Session::getId()]);
        if ($stat->updated_at < date('Y-m-d H:i:s',strtotime('-1 minute')) and $stat->user_token==Session::getId())
        {
            $stat->fill(['views'=>$stat->views+1]);
            $stat->save();
        }
        elseif ($stat->user_token!=Session::getId())
        {
            $stat->fill(['views'=>1]);
            $stat->save();
        }


        $parent_rubric = Rubric::whereAncestorOrSelf($bb->rubric_id)->orderBy('level')->get()->first();
        $title = $parent_rubric->title." ".$bb->rubric->title_r." ".$bb->vendor->name." ".$bb->title." в ".$bb->location->title_r;
        $images = UserFile::where('bb_id',$bb->id)->orderBy('sort')->get();

        return view('detail', ['bb' => $bb,'images'=>$images,'parent_rubric'=>$parent_rubric,'title'=>$title]);
    }
}
