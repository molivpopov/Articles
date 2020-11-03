<?php

use App\Http\Resources\ArticleCollection;
use App\Models\Comment;
use App\User;
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
//    'middleware' => 'authorizing:user,admin'
], function () {

    Route::apiResource('articles', 'ArticleController')->only([
        'index', 'show'
    ])->middleware('authorizing:user,admin');

    Route::apiResource('articles', 'ArticleController')->only([
        'store', 'update', 'destroy'
    ])->middleware('authorizing:admin');

//    Route::get('/article', function (Request $request) {
//
//        $articleId = $request->validate([
//            'article_id' => 'required|integer|exists:articles,id'
//        ])['article_id'];
//
//        return new ArticleResource(Article::find($articleId));
//    });
//
//    Route::get('/articles', function (Request $request) {
//
//        // todo filtering by multiple tags?
//
//        $tag = $request->input('tag', false);
//
//        $articles = $tag
//            ? Article::with('tags')
//                ->whereHas('tags', function ($q) use ($tag) {
//                    // it is safe? ()
//                    $q->where('name', strtolower($tag));
//                })
//                ->get()
//            : Article::all();
//
//        return new ArticleCollection($articles);
//    });
//
//    // todo - change method to post ??
//    Route::put('/comment', function (Request $request) {
//
//        $valid = $request->validate([
//            'article_id' => 'required|exists:articles,id',
//            'comment' => 'nullable|string'
//        ]);
//
//        $userId = User::where('uuid', $request->route()->parameter('code'))
//            ->first()
//            ->id;
//
//        $newComment = Comment::create(array_merge($valid, ['user_id' => $userId]));
//
//        return new \App\Http\Resources\CommentResource($newComment);
//
//    });
});

//Route::group([
//    'prefix' => '{code}',
//    'middleware' => 'authorizing:admin'
//], function () {
//    Route::apiResource('articles', 'ArticleController')->only([
//        'store', 'update', 'destroy'
//    ]);
//});

