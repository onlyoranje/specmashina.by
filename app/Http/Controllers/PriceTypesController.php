<?php

namespace App\Http\Controllers;

use App\Models\PriceType;
use App\Models\PriceTypeRubric;
use App\Models\Rubric;
use Illuminate\Http\Request;

class PriceTypesController extends Controller
{


    public function types(){

        $types = PriceType::orderBy('type')->paginate(15);
        return view('price_type.dashboard',compact('types'));

    }
    public function addTypeForm($id=false){
        $rubrics = Rubric::orderBy('sort')->get()->toTree();
        return view('price_type.add',[ 'rubrics'=>$rubrics]);
    }
    public function addTypetoDB(Request $request){
        if ($request->has_value) {$has_value=$request->has_value;} else {$has_value='N';}
        $pricetype = PriceType::create(['type'=>$request->type,'has_value'=>$has_value,'sort'=>$request->sort]);
        $pricetype->rubrics()->attach($request->rubrics);
        return redirect()->route('price_type_dashboard');
    }
    public function detail($id){
        $type     = PriceType::find($id);
        $rubrics = Rubric::orderBy('sort')->get()->toTree();
        return view('price_type.edit', ['rubrics'=>$rubrics,'type'=>$type]);

    }
    public function editType(Request $request, PriceType $type){

        if ($request->has_value) {$has_value=$request->has_value;} else {$has_value='N';}
        $type->fill(['type'=>$request->type,'has_value'=>$has_value,'sort'=>$request->sort]);
        $type->save();
        $type_rubric = $type->rubrics->pluck('id');
        $type_rubric_update = $request->rubrics;

        foreach ($type_rubric as $rubric_id){

            if (!in_array($rubric_id,$type_rubric_update)) PriceTypeRubric::where('rubric_id', $rubric_id)->where('price_type_id', $type->id)->delete();
        }
        $type_rubric = $type->rubrics->toArray();
        foreach ($type_rubric_update as $pr){
            if (!in_array($pr,$type_rubric)) PriceTypeRubric::updateOrCreate(['rubric_id'=>$pr,'price_type_id'=>$type->id]);
        }

        return redirect()->route('price_type_dashboard');
    }
    public function delete(PriceType $type){
        return view('price_type.delete', ['type'=>$type]);
    }
    public function destroy(PriceType $type){

        $type->delete();
        return redirect()->route('price_type_dashboard');
    }
}
