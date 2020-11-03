<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Image;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $tag = $request->input('tag', false);

        $articles = $tag
            ? Article::with('tags')
                ->whereHas('tags', function ($q) use ($tag) {
                    // it is safe? ()
                    $q->where('name', strtolower($tag));
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
        $newTitle = $request->validate([
            'title' => 'required|string',
            'image' => 'image|max:2000'
        ])['title'];

        $articleId = Article::create([
            'title' => $newTitle
        ])->id;

        $responseRequest = Request::create(
            $request->getUri() . '/' . $articleId,
            'PUT',
            $request->post(),
            $request->cookie(),
            $request->file()
        );

        //redirect to update method with PUT verb
        return Route::dispatch($responseRequest)->getContent();
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

        if (!$article) abort(404);

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

        if (!$article) abort(404);

        $valid = $request->validate([
            'title' => 'nullable|string',
            'body' => 'nullable|string',
            'tag' => 'nullable|string',
            'image' => 'image|max:2000'
        ]);

        $valid = array_filter($valid, function ($item) {
            return $item;
        });

        if ($valid['image']) {

            $path = Storage::putFile('public/' . $article->id, $valid['image']);

            Image::create([
                'article_id' => $article->id,
                'link' => $path,
                'name' => $valid['image']->getClientOriginalName()
            ]);

            unset($valid['image']);
        }

        if ($valid['tag']) {

            $tag = Tag::updateOrCreate(
                ['name' => strtolower($valid['tag'])]
            );

            ArticleTag::updateOrCreate(
                ['tag_id' => $tag->id, 'article_id' => $article->id]
            );

            unset($valid['tag']);
        }

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

        if (!$article) abort(404);

        $returnResource = new ArticleResource($article);

        $article->delete();

        return $returnResource;
    }
}
