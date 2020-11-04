<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Image;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return ArticleCollection
     */
    public function index(Request $request)
    {
        $valid = $request->validate([
            'tag' => 'string'
        ]);

        $articles = !empty($valid)
            ? Article::with('tags')
                ->whereHas('tags', function ($query) use ($valid) {
                    $query->where('name', strtolower($valid['tag']));
                })
                ->get()
            : Article::all();

        return new ArticleCollection($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ArticleResource
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'title' => 'required|string',
            'body' => 'string'
        ]);

        $article = Article::create($valid);

        return new ArticleResource($article);
    }

    /**
     * Display the specified resource.
     *
     * @param $code
     * @param $articleId
     * @return ArticleResource
     */
    public function show($code, $articleId)
    {
        $article = Article::find($articleId);

        return new ArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $code
     * @param $articleId
     * @return ArticleResource
     */
    public function update(Request $request, $code, $articleId)
    {
        $article = Article::find($articleId);

        $valid = $request->validate([
            'title' => 'required_without:body|string|max:255',
            'body' => 'required_without:title|string',
        ]);

        $article->update($valid);

        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $code
     * @param $articleId
     * @return ArticleResource
     */
    public function destroy($code, $articleId)
    {
        $article = Article::find($articleId);

        $returnResource = new ArticleResource($article);

        $article->delete();

        return $returnResource;
    }
}
