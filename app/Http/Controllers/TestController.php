<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        $comm = Comment::with('article')->find(2);
        dd($comm);
    }
}
