<?php

namespace App\Http\Controllers;

use App\Models\Bb;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search_result(Request $request){
        $result = Array();
        $text = $request->q;
        $text = preg_replace("|\b[\d\w]{1,3}\b|i","",$text);
        $text = preg_replace('/[\p{P}]/u', '', $text);;

        $words = explode(' ',$text);


        foreach ($words as $word){

            $bbs = Bb::where('search_text','LIKE','%'.$word.'%')->where('active','Y')->get();
            foreach ($bbs as $bb){
                if (!empty($bb)) $result[$bb->id][]=$word;
            }

        }
        if (count($result)>0){
            uasort($result, static function ($a, $b) {
                return count($a) < count($b);
            });
        }



//print_r($result);
        $result_bb = Bb::where('active','Y')->whereIn('id',array_keys($result))->orderByRaw( "FIELD(id, ".implode(",",array_keys($result)).")" )->paginate(15);
        //dd($result_bb);
        return view('search.result',['bbs'=>$result_bb,'query'=>$text]);
    }
}
