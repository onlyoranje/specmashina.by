<?php

namespace App\Http\Controllers;

use App\Models\Bb;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search_result(Request $request){

        $query = $request->q;
        //dd($query);
        $bbs = Bb::search($query)->where('active','Y')->paginate(15);
        return view('search.result',['bbs'=>$bbs,'query'=>$query]);
    }
}
