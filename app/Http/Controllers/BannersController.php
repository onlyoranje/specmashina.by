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
}
