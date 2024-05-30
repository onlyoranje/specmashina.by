<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    public function posts()
    {
        $posts=Post::where('active')->orderBy('id','desc')->paginate(10);
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

    }
}
