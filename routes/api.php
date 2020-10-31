<?php

use App\Http\Resources\ArticleCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ArticleResource;
use App\Models\Article;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => '{code}',
    'middleware' => 'authorizing:admin,user'
], function () {
    Route::get('/article', function (Request $request) {

        $id = $request->validate([
            'id' => 'required|integer|exists:articles,id'
        ])['id'];

        return new ArticleResource(Article::find($id));
    });

    Route::get('/articles', function (Request $request) {

        // todo filtering by multiple tags?

        $tag = $request->input('tag', false);

        $articles = $tag
            ? Article::with('tags')
                ->whereHas('tags', function ($q) use ($tag) {
                    // it is safe? ()
                    $q->where('name', $tag);
                })
                ->get()
            : Article::all();

        return new ArticleCollection($articles);
    });
});

