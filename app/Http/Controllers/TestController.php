<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Comment;
use App\Models\Image;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
//        $comm = Comment::with('article')->find(2);
//        $img= Image::with('article')->find(1);
        $vv = array('hello');
        unset($vv[0]);
        dd($vv);
        Image::find(2)->update($vv);
        dd('hello');
    }
}
