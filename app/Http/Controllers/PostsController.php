<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostStatistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostsController extends Controller
{
    //
    public function posts()
    {
        $posts=Post::where('active','Y')->orderBy('id','desc')->paginate(10);
        return view('post.list',['posts'=>$posts,'title'=>'Новости']);
    }
    public function posts_dashboard(){
        $posts=Post::orderBy('id','desc')->paginate(10);
        return view('post.dashboard',['posts'=>$posts,'title'=>'Новости']);
    }
    public function post_add(){
        $categories = Post::whereNotNull('category')->groupBy('category')->pluck('category');
        return view('post.add',['title'=>'Новости','categories'=>$categories]);
    }
    public function post_add_db(Request $request){
        $post = Post::create(['title'=>$request->title,'preview_text'=>$request->preview_text,'content'=>$request->text,'user_id'=>Auth::id()]);
        if ($request->new_category){
            $post->fill(['category'=> $request->new_category]);
            $post->save();
        } else {
            $post->fill(['category'=> $request->category]);
            $post->save();
        }
        if ($request->file) {

            $filename = $request->file[0]->store('public');
            $file_name = explode('/', $filename);
            $post->fill(['image'=> $file_name[1]]);
            $post->save();

        }
        return redirect()->route('posts_dashboard');

    }
    public function post_dashboard(Post $post){
        $title = 'Редактирование новости '.$post->title;
        return view('post.edit',['title'=>$title,'post'=>$post]);
    }
    public function post(Post $post){
        $title = $post->title;
        $stat = PostStatistic::updateOrCreate(['post_id'=>$post->id,'user_token'=> Session::getId()]);
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
        return view('post.detail',['title'=>$title,'post'=>$post]);
    }
}
