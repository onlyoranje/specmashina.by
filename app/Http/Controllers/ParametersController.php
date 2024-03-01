<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use App\Models\ParameterRubric;
use App\Models\ParameterType;
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

        $parameters = Parameter::orderBy('sort')->paginate(15);
        $types = ParameterType::orderBy('type_name')->get();
        return view('parameter.dashboard',['parameters'=>$parameters,'types'=>$types]);

    }
    public function addParameterForm($id=false){
        $types = ParameterType::get();
        $rubrics = Rubric::orderBy('sort')->get()->toTree();
        return view('parameter.add',[ 'types'=>$types,'rubrics'=>$rubrics]);
    }
    public function addParameter(Request $request){
        $validated = $request->validate(self::PAR_VALIDATOR,self::PAR_ERROR_MESSAGES);
        $options = NULL;
        $limit_min = NULL;
        $limit_max = NULL;
        $options_array = $request->options;
        $options_array = array_filter($options_array, fn($n) => !is_null($n));
        if ($request->type=='option') $options = json_encode($options_array);
        if ($request->type=='number' and isset($request->min)) $limit_min = $request->min;
        if ($request->type=='number' and isset($request->max)) $limit_min = $request->max;
        $parameter = Parameter::create(['name'=>$validated['name'],'measure'=>$request->measure,'type'=>$request->type,'sort'=>$request->sort,'options'=>$options,'min'=>$limit_min,'max'=>$limit_max]);
        $parameter->rubrics()->attach($request->rubrics);
        return redirect()->route('parameter_dashboard');
    }
    public function detail($id){
        $parameter     = Parameter::find($id);
        $types = ParameterType::get();
        $rubrics = Rubric::orderBy('sort')->get()->toTree();
        //$parameter_rubric = $parameter->rubrics->pluck('id');
        return view('parameter.edit', ['parameter'=>$parameter,'rubrics'=>$rubrics,'types'=>$types]);

    }
    public function editParameter(Request $request, Parameter $parameter){
        $validated = $request->validate(self::PAR_VALIDATOR,self::PAR_ERROR_MESSAGES);
        $options = NULL;
        $limit_min = NULL;
        $limit_max = NULL;
        if ($request->type=='number' and isset($request->min)) $limit_min = $request->min;
        if ($request->type=='number' and isset($request->max)) $limit_max= $request->max;
        $options_array = $request->options;
        $options_array = array_filter($options_array, fn($n) => !is_null($n));
        if ($request->type=='option') $options = json_encode($options_array);


        $parameter->fill(['name'=>$validated['name'],'measure'=>$request->measure,'type'=>$request->type,'sort'=>$request->sort,'options'=>$options,'min'=>$limit_min,'max'=>$limit_max]);
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

        // dd($request);
        return redirect()->route('parameter_dashboard');
    }
    public function delete(Parameter $parameter){
        return view('parameter.delete', ['parameter'=>$parameter]);
    }
    public function destroyParameter(Parameter $parameter){
        ParameterRubric::where('parameter_id', $parameter->id)->delete();
        $parameter->delete();
        return redirect()->route('parameter_dashboard');
    }
}
