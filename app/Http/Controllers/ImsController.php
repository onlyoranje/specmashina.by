<?php

namespace App\Http\Controllers;


use App\Models\Im;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImsController extends Controller
{
    //
    public function index(){
        $all_messages = Im::where('user1_id', Auth::id())->orWhere('user2_id', Auth::id())->orderby('created_at','asc')->get();
        foreach ($all_messages as $message)
        {
            if ($message->user1_id==Auth::id()) {
                $user1 = Auth::id();
                $user2 = $message->user2_id;
            }
            else{
                $user2 = Auth::id();
                $user1 = $message->user2_id;
            }
                $dialog[$user2]['updated_at'] = $message->updated_at;
                $dialog[$user2]['message'][] = Array($message->user1_id,$message->text);
                $dialog[$user2]['user'] = User::where('id',$user2)->get();

        }
        return view('im.im',['messages'=>$dialog]);
    }
}
