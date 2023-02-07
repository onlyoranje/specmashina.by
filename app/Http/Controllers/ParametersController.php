<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use App\Models\ParameterRubric;
use App\Models\Rubric;
use App\Models\TypeParameter;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Rule\Parameters;

class ParametersController extends Controller
{

    private const PAR_VALIDATOR = [
        'name' => 'required|max:50',

    ];

    private const PAR_ERROR_MESSAGES = [
        'required' => 'Заполните это поле',

    ];
    public function parameters(){

        $parameters = Parameter::orderBy('sort')->get();
        return view('parameter_dashboard',compact('parameters'));

    }
    public function addParameterForm($id=false){
        $types = TypeParameter::get();
        $rubrics = Rubric::orderBy('sort')->get()->toTree();
        return view('parameter_add',[ 'types'=>$types,'rubrics'=>$rubrics]);
    }
    public function addParameter(Request $request){
        $validated = $request->validate(self::PAR_VALIDATOR,self::PAR_ERROR_MESSAGES);
        //dd($request);
        $parameter = Parameter::create(['name'=>$validated['name'],'measure'=>$request->measure,'type'=>$request->type,'sort'=>$request->sort]);
        $parameter->rubrics()->attach($request->rubrics);
        return redirect()->route('parameter_dashboard');
    }
    public function detail($id){
        $parameter     = Parameter::find($id);
        $types = TypeParameter::get();
        $rubrics = Rubric::orderBy('sort')->get()->toTree();
        //$parameter_rubric = $parameter->rubrics->pluck('id');
        return view('parameter_edit', ['parameter'=>$parameter,'rubrics'=>$rubrics,'types'=>$types]);

    }
    public function editParameter(Request $request, Parameter $parameter){
        $validated = $request->validate(self::PAR_VALIDATOR,self::PAR_ERROR_MESSAGES);

        $parameter->fill(['name'=>$validated['name'],'measure'=>$request->measure,'type'=>$request->type,'sort'=>$request->sort]);
        $parameter->save();
        $parameter_rubric = $parameter->rubrics->pluck('id');
        $parameter_rubric_update = $request->rubrics;

        foreach ($parameter_rubric as $rubric_id){

            if (!in_array($rubric_id,$parameter_rubric_update)) ParameterRubric::where('rubric_id', $rubric_id)->where('parameter_id', $parameter->id)->delete();
        }
        $parameter_rubric = $parameter->rubrics->toArray();
        foreach ($parameter_rubric_update as $pr){
            if (!in_array($pr,$parameter_rubric)) ParameterRubric::updateOrCreate(['rubric_id'=>$pr,'parameter_id'=>$parameter->id]);
        }
        return redirect()->route('parameter_dashboard');
    }
    public function delete(Parameter $parameter){
        return view('deleteParameter', ['parameter'=>$parameter]);
    }
    public function destroyParameter(Parameter $parameter){
        ParameterRubric::where('parameter_id', $parameter->id)->delete();
        $parameter->delete();
        return redirect()->route('parameter_dashboard');
    }
}
