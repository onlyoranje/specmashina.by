<?php

namespace App\Http\Controllers;

use App\Models\Bb;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search_result(Request $request){

        $query = $request->q;
        //dd($query);
        $bbs = Bb::search($query)->get();
        return view('search.result',['bbs'=>$bbs,'query'=>$query]);
    }
}
