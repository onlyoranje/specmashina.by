<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {

        $context= ['message'=>$request->message,'user2'=>User::where('id',$request->user2)->first(),'user1'=>$request->user1];


        $returnHTML = view('notification.'.$request->category,$context)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));

    }
}
