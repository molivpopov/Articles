<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        $art = Article::with('tags')->find(1);
        dd($art);
    }
}
