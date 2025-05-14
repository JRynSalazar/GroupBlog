<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;

class NewsController extends Controller
{
    public function index()
    {
        $media = Media::all(); 
        return view('blog.news', compact('media')); 
    }

    public function showNews(){
        return view('blog.news');
    }
}
