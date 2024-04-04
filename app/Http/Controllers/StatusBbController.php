<?php

namespace App\Http\Controllers;

use App\Models\Status_bb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function addStatusForm(){
        return view('status_bb.add');
    }
    public function addStatus(Request $request){

        Status_bb::create([
            'name'=>$request->name,
            'active_status'=>$request->code,
            'price'=>$request->price,
            'period'=>$request->premium_status_days,
            'sort'=>$request->sort,
            'description'=>$request->description
        ]);
        return redirect()->route('status_dashboard');
    }
    public function editStatus(Request $request, Status_bb $status){
        $status->fill([
            'name'=>$request->name,
            'active_status'=>$request->code,
            'price'=>$request->price,
            'period'=>$request->premium_status_days,
            'sort'=>$request->sort,
            'description'=>$request->description
        ]);
        $status->save();
        return redirect()->route('status_dashboard');
    }
    public function delete($id){
        $status     = Status_bb::find($id);
        return view('status_bb.delete', ['status'=>$status]);
    }
    public function destroyStatus($id){
        $status     = Status_bb::find($id);
        $status->delete();
        return redirect()->route('status_dashboard');
    }

}
