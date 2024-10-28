<?php

namespace App\Http\Controllers;


use App\Models\Notification;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request)
    {

        $context= ['message'=>$request->message,'user1'=>User::where('id',$request->user1)->first(),'user2'=>$request->user2];


        $returnHTML = view('notification.'.$request->category,$context)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));

    }
    /*public function read_alert(Request $request)
    {
        Notification::where('id',$request->id)->where('user_id',Auth::id())->update(['read_at'=>date('Y-m-d H:i:s')]);
    }*/
}
