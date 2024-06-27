<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannersController extends Controller
{
    public function banners_dashboard(){
        $banners=Banner::orderBy('id','desc')->paginate(10);
        return view('banner.dashboard',['banners'=>$banners,'title'=>'Баннеры']);
    }
    public function banner_add(){

        return view('banner.add',['title'=>'Добавление баннера']);
    }
    public function banner_add_db(Request $request){


        $post = Banner::create(['title'=>$request->title,'url'=>$request->url,'start'=>$request->start,'end'=>$request->end,'maximum_views'=>$request->maximum_views]);

        if ($request->file) {

            $filename = $request->file[0]->store('public');
            $file_name = explode('/', $filename);
            $post->fill(['image'=> $file_name[1]]);
            $post->save();

        }
        return redirect()->route('banners_dashboard');

    }

    public function banner_dashboard(Banner $banner){

        $title = 'Редактирование баннера '.$banner->title;
        return view('banner.edit',['title'=>$title,'banner'=>$banner]);
    }
}
