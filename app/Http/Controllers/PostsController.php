<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('post.add',['title'=>'Новости']);
    }
    public function post_add_db(Request $request){
        $post = Post::create(['title'=>$request->title,'preview_text'=>$request->preview_text,'content'=>$request->text,'user_id'=>Auth::id()]);
        if ($request->file) {

            $filename = $request->file[0]->store('public');
            $file_name = explode('/', $filename);
            $post->fill(['image'=> $file_name[1]]);
            $post->save();

        }
        return redirect()->route('posts_dashboard');

    }
}
