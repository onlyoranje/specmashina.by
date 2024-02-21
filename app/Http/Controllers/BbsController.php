<?php

namespace App\Http\Controllers;

use App\Models\Bb;
use App\Models\Rubric;
use App\Models\UserFile;
use Illuminate\Http\Request;

class BbsController extends Controller
{
    public function index() {

        $context = ['bbs' => Bb::latest()->paginate(10),'rubrics'=>Rubric::orderBy('sort')->orderBy('title')->get()->toTree()];
        return view('welcome', $context);
    }
    public function detail(Bb $bb) {
        //test
       // $rubric = $bb->rubric();
        $images = UserFile::where('bb_id',$bb->id)->orderBy('sort')->get();
        return view('detail', ['bb' => $bb,'images'=>$images]);
    }
}
