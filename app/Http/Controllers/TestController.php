<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Comment;
use App\Models\Image;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request)
    {
        $c = Comment::with('user')->find(null);
        dd($c);
    }
}
