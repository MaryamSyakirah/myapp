<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to Laravel!';
//        return view('pages.index', compact('title')); //first way to post the title (dynamic way kalau tak silap)
        //can use as passing array
        return view('pages.index')->with('title', $title);
    }
    //
    public function about(){
        return view('pages.about');
    }
    public function services(){
//        passing multiple value
        $data = array(
            'title' => 'The Services page',
            'services' => ['Web design', 'Programming', 'SEO']
        );
        return view('pages.services')->with($data);
    }
}
