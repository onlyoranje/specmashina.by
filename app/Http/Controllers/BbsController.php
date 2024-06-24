<?php

namespace App\Http\Controllers;

use App\Events\NewMessageNotification;
use App\Models\Bb;
use App\Models\BbAdminComments;
use App\Models\BbStatistic;
use App\Models\Im;
use App\Models\Location;
use App\Models\Notification;
use App\Models\RejectReasons;
use App\Models\Rubric;
use App\Models\Status_bb;
use App\Models\UserFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BbsController extends Controller
{
    public function index() {

        $context = [
            'bbs_last' => Bb::select('bbs.*')->join('status_bbs','bbs.status_bb_id','=','status_bbs.id')->where('status_bbs.active','Y')->orderBy('bbs.created_at','desc')->limit(8)->get(),
            'bbs_random' => Bb::select('bbs.*')->join('status_bbs','bbs.status_bb_id','=','status_bbs.id')->where('status_bbs.active','Y')->inRandomOrder()->limit(8)->get(),
            'bbs_actual' => Bb::select('bbs.*')->join('status_bbs','bbs.status_bb_id','=','status_bbs.id')->where('status_bbs.active','Y')->orderBy('lifted_at','desc')->orderBy('bbs.updated_at','desc')->limit(6)->get(),
            'bbs_popular' => Bb::select('bbs.*')->join('status_bbs','bbs.status_bb_id','=','status_bbs.id')->where('status_bbs.active','Y')->addSelect(['bbstatistic_count' => BbStatistic::selectRaw('sum(views) as total')
                ->whereColumn('bb_id', 'bbs.id')
                ->groupBy('bb_id')
            ])->orderBy('bbstatistic_count','desc')->limit(8)->get(),
            'rubrics'=>Rubric::orderBy('sort')->orderBy('title')->get()->toTree(),
            'rubrics_slider'=>Rubric::withCount('bbs')->where('level',2)->where('title','!=','Другое')->orderBy('bbs_count','desc')->limit(12)->inRandomOrder()->get(),
            'bbs_city'=>Location::withCount([
                'bbs' => function (Builder $query) {
                    $query->where('active', 'Y');
                },
            ])->where('level',1)->orderBy('bbs_count','desc')->limit(10)->get()

        ];
        return view('home', $context);
    }
    public function detail(Bb $bb,Request $request) {

        if ($bb->status_bb->active != 'Y' and Auth::id()==false) abort(404);
        if ($bb->status_bb->active != 'Y' and Auth::user()->isAdmin()==false and $bb->user->id!=Auth::id()) abort(404);
        $reasons = RejectReasons::all();
        $stat = BbStatistic::updateOrCreate(['bb_id'=>$bb->id,'user_token'=> Session::getId()]);
        if ($stat->updated_at < date('Y-m-d H:i:s',strtotime('-1 minute')) and $stat->user_token==Session::getId())
        {
            $stat->fill(['views'=>$stat->views+1]);
            $stat->save();
        }
        elseif ($stat->user_token!=Session::getId())
        {
            $stat->fill(['views'=>1]);
            $stat->save();
        }


        $parent_rubric = Rubric::whereAncestorOrSelf($bb->rubric_id)->orderBy('level')->get()->first();
        $title = $parent_rubric->title." ".$bb->rubric->title_r." ".$bb->vendor->name." ".$bb->title." в ".$bb->location->title_r;
        $images = UserFile::where('bb_id',$bb->id)->orderBy('sort')->get();

        return view('detail', ['bb' => $bb,'images'=>$images,'parent_rubric'=>$parent_rubric,'title'=>$title, 'reasons'=>$reasons]);
    }
    public function approve(Bb $bb,Request $request){
        $parent_rubric = Rubric::whereAncestorOrSelf($bb->rubric_id)->orderBy('level')->get()->first();
        $title = $parent_rubric->title." ".$bb->rubric->title_r." ".$bb->vendor->name." ".$bb->title." в ".$bb->location->title_r;
        BbAdminComments::create(['bb_id'=>$bb->id,'comment'=>'Объявление '.$title.' прошло модерацию']);
        $msg = Im::create(['user1_id'=>Auth::id(),'user2_id'=>$bb->user->id,'text'=>'Объявление '.$title.' прошло модерацию']);
        $active_status = Status_bb::where('status','S')->get()->value('id');
        Bb::where('id',$bb->id)->update(['status_bb_id'=>$active_status]);
        event(new NewMessageNotification('new_message',$msg ,Auth::id(),$bb->user->id));
        Notification::create(['type'=>'new_message','user_id'=>$bb->user->id,'data'=>$msg->text]);
        return redirect()->route('admin_dashboard');
    }
    public function reject(Bb $bb,Request $request){
        $parent_rubric = Rubric::whereAncestorOrSelf($bb->rubric_id)->orderBy('level')->get()->first();
        $title = $parent_rubric->title." ".$bb->rubric->title_r." ".$bb->vendor->name." ".$bb->title." в ".$bb->location->title_r;
        $comment = 'Объявление '.$title.' не прошло модерацию<br>';
        if ($request->reasons){
            foreach ($request->reasons as $reason)
            {
                $comment.= RejectReasons::where('id',$reason)->value('reason').'<br>';
            }
        }
        if ($request->comment) $comment.= $request->comment;
        BbAdminComments::create(['bb_id'=>$bb->id,'comment'=>$comment]);
        $msg = Im::create(['user1_id'=>Auth::id(),'user2_id'=>$bb->user->id,'text'=>$comment]);
        event(new NewMessageNotification('new_message',$msg,Auth::id(),$bb->user->id));
        $active_status = Status_bb::where('status','N')->get()->value('id');
        Bb::where('id',$bb->id)->update(['status_bb_id'=>$active_status]);
        Notification::create(['type'=>'new_message','user_id'=>$bb->user->id,'data'=>$msg->text]);
        return redirect()->route('admin_dashboard');
    }

}
