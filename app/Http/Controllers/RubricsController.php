<?php

namespace App\Http\Controllers;

use App\Models\Bb;
use App\Models\Location;
use App\Models\ParameterRubric;
use App\Models\Rubric;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class RubricsController extends Controller
{
    private const RUB_VALIDATOR = [
        'title'=> 'required|max:100'
    ];
    private const RUB_ERROR_MESSAGES = [
        'max'=>' Значение не долно быть длиннее :max символов'
    ];
    public function detail($id){
        $rubric     = Rubric::find($id);
        $rubrics    = Rubric::orderBy('sort')->orderBy('title')->get()->toTree();
        $depth      = Rubric::descendantsAndSelf($id)->toFlatTree();
        $icons      = Storage::disk('public')->allFiles('/categories');


        return view('rubric.edit', ['rubric'=>$rubric,'rubrics'=>$rubrics,'depth'=>$depth, 'icons'=>$icons]);

    }
    public function rubric(Request $request,$id){

        if (isset($_SERVER['HTTP_REFERER']) and !str_contains(strstr($_SERVER['HTTP_REFERER'], '?', true),$_SERVER['REDIRECT_URL'])) {
            //unset($query);
redirect()->route('rubric',$id);
        }



        $rubric     = Rubric::find($id);
        $rubrics    = Rubric::descendantsAndSelf($id)->pluck('id');
        $bbs    = Bb::select('bbs.*')->
        Join('status_bbs','bbs.status_bb_id','=','status_bbs.id')->

        where('status_bbs.active','Y')->
        whereIn('rubric_id',$rubrics)->
        where(function($query)
        {
            global $request;
            if ($request->location) $query->where('location_id', $request->location );

                })->
        orderBy('status_bbs.sort_on_board','asc')->
        orderBy('lifted_at', 'desc')->
        orderBy('bbs.created_at','desc')->
        paginate(12);
        $locations = Location::where('level',1)->orderBy('title')->get();

        $breadcrumbs['route']= 'rubric';
        $breadcrumbs['list']= Rubric::ancestorsAndSelf($id);
        //$parent_rubric = $breadcrumbs[0];
        $title = $rubric->title();

        return view('rubric.rubric', ['rubric'=>$rubric,'rubrics'=>$rubrics,'breadcrumbs'=>$breadcrumbs,'bbs'=>$bbs,'title'=>$title,'locations'=>$locations,'request'=>$request]);

    }
    public function location(Request $request,$id){
        $rubric = Rubric::find($request->rubric);

        $location     = Location::find($id);
        $locations    = Location::descendantsAndSelf($id)->pluck('id');
        $bbs    = Bb::whereIn('location_id',$locations)->select('bbs.*')->Join('status_bbs','bbs.status_bb_id','=','status_bbs.id')->where('status_bbs.active','Y')->orderBy('lifted_at', 'desc')->paginate(12);
        $title = "Спецтехника в ".$location->title_r;
        if ($rubric){
            switch ($rubric->id) {
                case 1:
                    $title  = "Аренда спецтехники в ".$location->title_r;
                    break;

                case 118:
                    $title  = "Продажа спецтехники в ".$location->title_r;
                    break;

                default:
                    $title = $rubric->title()." в ".$location->title_r;
                    break;

            }
        }


        $breadcrumbs['route'] = 'location';
        $breadcrumbs['list']= Location::ancestorsAndSelf($id);
        return view('rubric.rubric', ['location'=>$location,'locations'=>$locations,'breadcrumbs'=>$breadcrumbs,'bbs'=>$bbs,'title'=>$title,'request'=>$request,'rubric'=>$rubric]);

    }
    public function rubrics(){

        $rubrics = Rubric::orderBy('sort')->orderBy('title')->get()->toTree();
        return view('rubric.dashboard',compact('rubrics'));

    }
    public function addRubricForm(){
        $rubrics = Rubric::orderBy('sort')->orderBy('title')->get()->toTree();
        $icons      = Storage::disk('public')->allFiles('/categories');
        return view('rubric.add',['rubrics'=>$rubrics, 'icons'=>$icons]);
    }
    public function addRubric(Request $request){
        $validated = $request->validate(self::RUB_VALIDATOR,self::RUB_ERROR_MESSAGES);
        if ($request->parent_id)
            $level = (Rubric::find($request->parent_id)->level)+1;
        else
            $level=0;
        Rubric::create(['title'=>$validated['title'],'icon'=>$request->icon,'parent_id'=>$request->parent_id,'level'=>$level,'description'=>$request->description]);
        return redirect()->route('rubric_dashboard');
    }
    public function editRubric(Request $request, Rubric $rubric){
        $validated = $request->validate(self::RUB_VALIDATOR,self::RUB_ERROR_MESSAGES);
        if ($request->parent_id)
            $level = (Rubric::find($request->parent_id)->level)+1;
        else
            $level=0;
        $rubric->fill(['title'=>$validated['title'],'icon'=>$request->icon, 'title_r'=>$request->title_r,'parent_id'=>$request->parent_id,'level'=>$level,'description'=>$request->description,'sort'=>$request->sort]);
        $rubric->save();
        return redirect()->route('rubric_dashboard');
    }

    public function delete(Rubric $rubric){
        return view('rubric.delete', ['rubric'=>$rubric]);
    }
    public function destroyRubric(Rubric $rubric){

        ParameterRubric::where('rubric_id', $rubric->id)->delete();
        $rubric->delete();
        return redirect()->route('rubric_dashboard');
    }
}
