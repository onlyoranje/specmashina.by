<?php

namespace App\Http\Controllers;


use App\Events\NewMessageNotification;
use App\Models\Im;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImsController extends Controller
{
    //
    public function index(){
        $dialog = [];
        $all_messages = Im::where('user1_id', Auth::id())->orWhere('user2_id', Auth::id())->orderby('created_at','asc')->get();
        foreach ($all_messages as $message)
        {
            if ($message->user1_id==Auth::id()) {
                $user2 = $message->user2_id;
                $user1 = $message->user1_id;
            }
            else{
                $user2 = $message->user1_id;
                $user1 = $message->user2_id;
                if (!isset($message->read_at))
                    {
                        if (isset($dialog['D_'.$user2]['unread']))
                            $dialog['D_'.$user2]['unread']++;
                        else
                            $dialog['D_'.$user2]['unread']=1;
                    }
            }
                $dialog['D_'.$user2]['updated_at'] = $message->updated_at;
                //$dialog['D_'.$user2]['message'][] = $message;
                $dialog['D_'.$user2]['last_message'] = Str::limit(strip_tags($message->text),50);
                $dialog['D_'.$user2]['user1'] = User::where('id',$user1)->first();
                $dialog['D_'.$user2]['user2'] = User::where('id',$user2)->first();

        }

        uasort($dialog, function ($a, $b)
        {
            if ($a['updated_at'] == $b['updated_at']) {
                return 0;
            }
            return ($a['updated_at'] < $b['updated_at']) ? -1 : 1;
        });
        $dialog= array_reverse($dialog);
        $context = ['messages'=>$dialog,'show_chat'=>array_key_first($dialog)];
        return view('im.im',$context);
    }

    public function chats(){
        $dialog = [];
        $all_messages = Im::where('user1_id', Auth::id())->orWhere('user2_id', Auth::id())->orderby('created_at','asc')->get();
        foreach ($all_messages as $message)
        {
            if ($message->user1_id==Auth::id()) {
                $user2 = $message->user2_id;
                $user1 = $message->user1_id;
            }
            else{
                $user2 = $message->user1_id;
                $user1 = $message->user2_id;
                if (!isset($message->read_at))
                {
                    if (isset($dialog['D_'.$user2]['unread']))
                        $dialog['D_'.$user2]['unread']++;
                    else
                        $dialog['D_'.$user2]['unread']=1;
                }
            }
            $dialog['D_'.$user2]['updated_at'] = $message->updated_at;
            //$dialog['D_'.$user2]['message'][] = $message;
            $dialog['D_'.$user2]['last_message'] = Str::limit(strip_tags($message->text),50);
            $dialog['D_'.$user2]['user1'] = User::where('id',$user1)->first();
            $dialog['D_'.$user2]['user2'] = User::where('id',$user2)->first();

        }

        uasort($dialog, function ($a, $b)
        {
            if ($a['updated_at'] == $b['updated_at']) {
                return 0;
            }
            return ($a['updated_at'] < $b['updated_at']) ? -1 : 1;
        });
        $dialog= array_reverse($dialog);
        $context = ['messages'=>$dialog,'show_chat'=>array_key_first($dialog)];
        return response()->view('im.chats',$context,200);
    }

    public function new_msg(Request $request)
    {

        $msg = Im::create([
            'user1_id' => Auth::id(),
            'user2_id' => $request->user2,
            'text' => $request->msg
        ]);

        event(new NewMessageNotification('new_message',$msg,Auth::id(),$request->user2));
        return response()->json(['code'=>200, 'message'=>'Запись успешно создана','data' => $msg], 200);

    }
    public function read_msg(Request $request)
    {
        $msg_id = substr($request->id,3);
        $msg = Im::where('id',$msg_id)->where('user2_id',Auth::id())->update(['read_at'=>date('Y-m-d H:i:s')]);

        //return response()->json(['code'=>200, 'message'=>'Запись успешно создана','data' => $msg], 200);

    }
    public function chat($id)
    {
        $dialog = [];
        $user2=substr($id,2);
        $all_messages = Im::whereIn('user1_id', [Auth::id(),$user2])->whereIn('user2_id', [Auth::id(),$user2])->orderby('created_at','asc')->get();
        foreach ($all_messages as $message)
        {
            if ($message->user1_id==Auth::id()) {
                $user2 = $message->user2_id;
                $user1 = $message->user1_id;
            }
            else{
                $user2 = $message->user1_id;
                $user1 = $message->user2_id;
                if (!isset($message->read_at))
                {
                    if (isset($dialog['D_'.$user2]['unread']))
                        $dialog['D_'.$user2]['unread']++;
                    else
                        $dialog['D_'.$user2]['unread']=1;
                }
            }
            $dialog['D_'.$user2]['updated_at'] = $message->updated_at;
            $dialog['D_'.$user2]['message'][] = $message;
            $dialog['D_'.$user2]['last_message'] = Str::limit(strip_tags($message->text),50);
            if (!isset($dialog['D_'.$user2]['user1'])) $dialog['D_'.$user2]['user1'] = User::where('id',$user1)->first();
            if (!isset($dialog['D_'.$user2]['user2'])) $dialog['D_'.$user2]['user2'] = User::where('id',$user2)->first();

        }

        uasort($dialog, function ($a, $b)
        {
            if ($a['updated_at'] == $b['updated_at']) {
                return 0;
            }
            return ($a['updated_at'] < $b['updated_at']) ? -1 : 1;
        });
        $dialog= array_reverse($dialog);
        $context = ['messages'=>$dialog];
        return response()->view('im.im_ajax',$context,200);
    }

}
