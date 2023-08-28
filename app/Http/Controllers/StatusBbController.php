<?php

namespace App\Http\Controllers;

use App\Models\Status_bb;
use Illuminate\Http\Request;

class StatusBbController extends Controller
{
    //
    public function detail($id){
        $status     = Status_bb::find($id);
        return view('status_bb.edit', compact('status'));

    }
    public function statuses(){

        $statuses = Status_bb::orderBy('sort')->get();
        return view('status_bb.dashboard',compact('statuses'));

    }
}
