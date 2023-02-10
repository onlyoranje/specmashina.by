<?php

namespace App\Http\Controllers;

use App\Models\ParameterRubric;
use App\Models\Rubric;
use Illuminate\Http\Request;

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

        return view('rubric.edit', ['rubric'=>$rubric,'rubrics'=>$rubrics,'depth'=>$depth]);

    }
    public function rubric($id){
        $rubric     = Rubric::find($id);
        $rubrics    = Rubric::descendantsAndSelf($id)->pluck('id');
        $announcements    = Bb::whereIn('rubric_id',$rubrics)->get();
        $breadcrumbs= Rubric::ancestorsAndSelf($id);
        return view('rubric.rubric', ['rubric'=>$rubric,'rubrics'=>$rubrics,'breadcrumbs'=>$breadcrumbs,'announcements'=>$announcements]);

    }
    public function rubrics(){

        $rubrics = Rubric::orderBy('sort')->orderBy('title')->get()->toTree();
        return view('rubric.dashboard',compact('rubrics'));

    }
    public function addRubricForm(){
        $rubrics = Rubric::orderBy('sort')->orderBy('title')->get()->toTree();

        return view('rubric.add',compact('rubrics'));
    }
    public function addRubric(Request $request){
        $validated = $request->validate(self::RUB_VALIDATOR,self::RUB_ERROR_MESSAGES);
        if ($request->parent_id)
            $level = (Rubric::find($request->parent_id)->level)+1;
        else
            $level=0;
        Rubric::create(['title'=>$validated['title'],'parent_id'=>$request->parent_id,'level'=>$level,'description'=>$request->description]);
        return redirect()->route('rubric.dashboard');
    }
    public function editRubric(Request $request, Rubric $rubric){
        $validated = $request->validate(self::RUB_VALIDATOR,self::RUB_ERROR_MESSAGES);
        if ($request->parent_id)
            $level = (Rubric::find($request->parent_id)->level)+1;
        else
            $level=0;
        $rubric->fill(['title'=>$validated['title'],'parent_id'=>$request->parent_id,'level'=>$level,'description'=>$request->description,'sort'=>$request->sort]);
        $rubric->save();
        return redirect()->route('rubric.dashboard');
    }

    public function delete(Rubric $rubric){
        return view('rubric.delete', ['rubric'=>$rubric]);
    }
    public function destroyRubric(Rubric $rubric){

        ParameterRubric::where('rubric_id', $rubric->id)->delete();
        $rubric->delete();
        return redirect()->route('rubric.dashboard');
    }
}
