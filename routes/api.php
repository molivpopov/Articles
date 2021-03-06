<?php

use Illuminate\Support\Facades\Route;

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

Route::group([
    'prefix' => '{code}',
    'namespace' => 'API',
    'middleware' => 'check.article'
], function () {

    Route::apiResource('articles', 'ArticleController')
        ->only(['index', 'show'])
        ->middleware(['authorizing:user,admin', 'drop.null']);

    Route::apiResource('articles', 'ArticleController')
        ->only(['store', 'update', 'destroy'])
        ->middleware(['authorizing:admin', 'drop.null']);

    Route::apiResource('articles.comments', 'CommentController')
        ->shallow()
        ->only(['store', 'destroy', 'update'])
        ->middleware(['authorizing:user,admin']);

    Route::apiResource('articles.tag', 'TagController')
        ->scoped(['tag'])
        ->only(['store', 'destroy'])
        ->middleware(['authorizing:admin']);

    Route::apiResource('articles.image', 'ImageController')
        ->shallow()
        ->only(['store', 'destroy'])
        ->middleware(['authorizing:admin']);

});

