<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Comment;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Routing\CompiledRouteCollection;
use Illuminate\Support\Facades\Route;

class TestController extends Controller
{
    public function test(Request $request)
    {

        $arr = [];

//        $route = CompiledRouteCollection::getRoutes();
//
//        dd($route);

        foreach (Route::getRoutes() as $route) {
            if ($route->getPrefix() == 'api/{code}')
                $arr[] = [
                    'uri' => $route->uri(),
                    'verb' => $route->methods()[0]
                ];
        }

        dd($arr);
    }
}
