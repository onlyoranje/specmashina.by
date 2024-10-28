<?php

namespace App\Http\Controllers;

use App\Models\ParameterType;
use Illuminate\Http\Request;

class ParameterTypesController extends Controller
{
    //


    public function types(){

        $types = ParameterType::orderBy('type_name')->paginate(15);
        return view('parameter_type.dashboard',compact('types'));

    }
    public function addTypeForm($id=false){
        $types = Array('text','number','option','checkbox');
        return view('parameter_type.add',compact('types'));
    }
    public function addTypetoDB(Request $request){
//dd($request);
        ParameterType::create(['type'=>$request->type,'type_name'=>$request->type_name]);

        return redirect()->route('parameter_type_dashboard');
    }
    public function detail($id){
        $types = Array('text','number','option','checkbox');
        $type     = ParameterType::find($id);

        return view('parameter_type.edit', ['type'=>$type,'types'=>$types]);

    }
    public function editType(Request $request, ParameterType $type){

        //dd($type);
        $type->fill(['type'=>$request->type,'type_name'=>$request->type_name]);
        $type->save();

        return redirect()->route('parameter_type_dashboard');
    }
    public function delete(ParameterType $type){
        return view('parameter_type.delete', ['type'=>$type]);
    }
    public function destroy(ParameterType $type){

        $type->delete();
        return redirect()->route('parameter_type_dashboard');
    }

}
