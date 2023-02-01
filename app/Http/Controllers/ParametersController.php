<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Rule\Parameters;

class ParametersController extends Controller
{
    public function parameters(){

        $parameters = Parameter::orderBy('sort')->get();
        return view('parameter_dashboard',compact('parameters'));

    }
    public function addParameterForm(){
        $parameters = Parameter::orderBy('sort')->get();

        return view('parameter_add',compact('parameters'));
    }
}
