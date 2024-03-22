<?php

namespace App\Http\Controllers;

use App\Models\Bb;
use App\Models\Rubric;
use App\Models\UserFile;
use Illuminate\Http\Request;

class BbsController extends Controller
{
    public function index() {

        $context = [
            'bbs_actual' => Bb::orderBy('lifted_at')->orderBy('updated_at')->limit(6)->get(),
            'rubrics'=>Rubric::orderBy('sort')->orderBy('title')->get()->toTree()
        ];
        return view('home', $context);
    }
    public function detail(Bb $bb) {
        //test
       // $rubric = $bb->rubric();
        $parent_rubric = Rubric::whereAncestorOrSelf($bb->rubric_id)->orderBy('level')->get()->first();
        $title = $parent_rubric->title." ".$bb->rubric->title_r." ".$bb->vendor->name." ".$bb->title." в ".$bb->location->title_r;
        $images = UserFile::where('bb_id',$bb->id)->orderBy('sort')->get();
        return view('detail', ['bb' => $bb,'images'=>$images,'parent_rubric'=>$parent_rubric,'title'=>$title]);
    }
}
