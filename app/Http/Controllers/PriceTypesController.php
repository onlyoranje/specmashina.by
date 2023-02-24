<?php

namespace App\Http\Controllers;

use App\Models\PriceType;
use Illuminate\Http\Request;

class PriceTypesController extends Controller
{


    public function types(){

        $types = PriceType::orderBy('type')->get();
        return view('price_type.dashboard',compact('types'));

    }
    public function addTypeForm($id=false){

        return view('price_type.add');
    }
    public function addTypetoDB(Request $request){
//dd($request);
        PriceType::create(['type'=>$request->type]);

        return redirect()->route('price_type_dashboard');
    }
    public function detail($id){
        $type     = PriceType::find($id);
        return view('price_type.edit', ['type'=>$type]);

    }
    public function editType(Request $request, PriceType $type){


        $type->fill(['type'=>$request->type]);
        $type->save();

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
