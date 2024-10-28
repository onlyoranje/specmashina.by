<?php

namespace App\Http\Controllers;

use App\Models\Bb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maize\Markable\Models\Bookmark;
use Maize\Markable\Models\Like;
use App\Models\User;

class BookmarkController extends Controller
{
    public function bookmarked (Request $request){
        $bb = Bb::where('id',$request->id)->firstOrFail();
        $user = Auth::user();
        if ($request->bookmark=='true'){
            Bookmark::remove($bb, $user);
            return 'remove';

        } else {

            Bookmark::add($bb, $user);
            return 'add';
        }

    }
}
