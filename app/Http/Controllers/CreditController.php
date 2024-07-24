<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    //
    public function index(){
        $credits = Auth::user()->credit->credits;
        $credits_log = Auth::user()->credits_log;
        return view('credit.dashboard',['credits'=>$credits, 'credits_log'=>$credits_log]);
    }
}
