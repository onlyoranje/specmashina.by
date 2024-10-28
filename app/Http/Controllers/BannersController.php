<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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


        $banner = Banner::create(['title'=>$request->title,'url'=>$request->url,'start'=>$request->start,'end'=>$request->end,'maximum_views'=>$request->maximum_views]);

        if ($request->file1) {

            $filename = $request->file1->store('public');
            $file_name = explode('/', $filename);
            $banner->fill(['image'=> $file_name[1]]);
            $banner->save();

        }
        return redirect()->route('banners_dashboard');

    }

    public function banner_dashboard(Banner $banner){

        $title = 'Редактирование баннера '.$banner->title;
        return view('banner.edit',['title'=>$title,'banner'=>$banner]);
    }
    public function edit_banner(Banner $banner,Request $request){

        $banner->fill(['title'=>$request->title,'url'=>$request->url,'start'=>$request->start,'end'=>$request->end,'maximum_views'=>$request->maximum_views]);
        $banner->save();

        if ($request->file1) {

            $filename = $request->file1->store('public');

            $file_name = explode('/', $filename);
            $banner->fill(['image'=> $file_name[1]]);
            $banner->save();

        }
        return redirect()->route('banners_dashboard');
    }
    public function banner(Banner $banner){
        $banner->update(['clicks'=>($banner->clicks+1)]);
        return    Redirect::to($banner->url.'?utm_source=specmashina.by&utm_medium=banner&utm_campaign=banner');
    }
}
