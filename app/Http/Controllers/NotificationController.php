<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {

        $context= ['message'=>$request->message,'user1'=>User::where('id',$request->user1)->first(),'user2'=>$request->user2];
//dd($request);

        $returnHTML = view('notification.'.$request->category,$context)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));

    }
}
