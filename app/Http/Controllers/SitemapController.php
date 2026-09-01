<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Bb;

use Illuminate\Http\Response;



class SitemapController extends Controller

{

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function index(): Response

    {
        $bbs = Bb::select('bbs.*')->join('status_bbs','bbs.status_bb_id','=','status_bbs.id')->where('status_bbs.active','Y')->orderBy('bbs.id','desc')->get();
        $posts = Post::latest()->get();



        return response()->view('sitemap', [

            'posts' => $posts,
            'bbs' => $bbs

        ])->header('Content-Type', 'text/xml');

    }

}