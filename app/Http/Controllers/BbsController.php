<?php

namespace App\Http\Controllers;

use App\Models\Bb;
use App\Models\Rubric;
use Illuminate\Http\Request;

class BbsController extends Controller
{
    public function index() {

        $context = ['bbs' => Bb::latest()->get()];
        return view('welcome', $context);
    }
    public function detail(Bb $bb) {
       // $rubric = $bb->rubric();
        return view('detail', ['bb' => $bb]);
    }
}
