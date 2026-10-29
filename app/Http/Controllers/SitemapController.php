<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Bb;
use App\Models\Rubric;
use App\Models\Location;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $posts = Post::latest()->take(1000)->get();
        $bbs = Bb::select('bbs.*')
            ->join('status_bbs', 'bbs.status_bb_id', '=', 'status_bbs.id')
            ->where('status_bbs.active', 'Y')
            ->orderBy('bbs.id', 'desc')
            ->take(5000)
            ->get();
        $rubrics = Rubric::all();
        $locations = Location::all();

        return response()->view('sitemap', [
            'posts' => $posts,
            'bbs' => $bbs,
            'rubrics' => $rubrics,
            'locations' => $locations,
        ])->header('Content-Type', 'text/xml');
    }
}
