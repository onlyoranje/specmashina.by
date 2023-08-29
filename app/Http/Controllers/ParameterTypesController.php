<?php

namespace App\Http\Controllers;

use App\Models\ParameterType;
use Illuminate\Http\Request;

class ParameterTypesController extends Controller
{
    //


    public function types(){

        $types = ParameterType::orderBy('type_name')->get();
        return view('parameter_type.dashboard',compact('types'));

    }
    public function addTypeForm($id=false){

        return view('parameter_type.add');
    }
    public function addTypetoDB(Request $request){
//dd($request);
        ParameterType::create(['type'=>$request->type,'type_name'=>$request->type_name]);

        return redirect()->route('parameter_dashboard');
    }
    public function detail($id){
        $type     = ParameterType::find($id);

        return view('parameter_type.edit', ['type'=>$type]);

    }
    public function editType(Request $request, ParameterType $type){


        $type->fill(['type'=>$request->type,'type_name'=>$request->type_name]);
        $type->save();

        return redirect()->route('parameter_dashboard');
    }
    public function delete(ParameterType $type){
        return view('parameter_type.delete', ['type'=>$type]);
    }
    public function destroy(ParameterType $type){

        $type->delete();
        return redirect()->route('parameter_dashboard');
    }

}
