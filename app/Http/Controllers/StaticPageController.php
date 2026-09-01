<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StaticPages;
class StaticPageController extends Controller
{

    //
    public function pages()
    {
        $pages=StaticPages::all();
        $title = 'Информация';

        return view('pages.list',['pages'=>$pages,'title'=>$title]);
    }
    public function pages_dashboard(){
        $pages=StaticPages::all();
        return view('page.dashboard',['pages'=>$pages,'title'=>'Статические страницы']);
    }
    public function page_add(){

        return view('page.add',['title'=>'Статические страницы']);
    }
    public function page_add_db(Request $request){

        $page = StaticPages::create(['title'=>$request->title,'content'=>$request->text]);

        return redirect()->route('pages_dashboard');

    }
    public function page_dashboard(StaticPages $page){

        $title = 'Редактирование страницы '.$page->title;
        return view('page.edit',['title'=>$title,'page'=>$page]);
    }
    public function page(StaticPages $page){
        $title = $page->title;
        $breadcrumbs['list'][] = Array('route'=>'pages','title'=>'Информация');
        return view('page.detail',['title'=>$title,'page'=>$page,'breadcrumbs'=>$breadcrumbs]);
    }
    public function edit_page(StaticPages $page,Request $request){


        $page->fill(['title'=>$request->title,'content'=>$request->text]);
        $page->save();

        return redirect()->route('pages_dashboard');
    }
    public function delete_page(StaticPages $page){
        $title = "Удалить страницу ".$page->title;
        return view('page.delete',['title'=>$title,'page'=>$page]);
    }
    public function destroy_page(StaticPages $page){
        $page->delete();
        return redirect()->route('pages_dashboard');
    }
}