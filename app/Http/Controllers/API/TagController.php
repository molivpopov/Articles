<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\TagResource;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $code
     * @param int $articleId
     * @return ArticleResource
     */
    public function store(Request $request, string $code, int $articleId)
    {
        $valid = $request->validate([
            'tag' => 'required|string|max:255'
        ]);

        $tag = Tag::updateOrCreate(
            ['name' => strtolower($valid['tag'])]
        );

        ArticleTag::updateOrCreate(
            ['tag_id' => $tag->id, 'article_id' => $articleId]
        );

        return new ArticleResource(Article::find($articleId));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $code
     * @param int $articleId
     * @param string $tag
     * @return ArticleResource
     * @throws \Exception
     */
    public function destroy(string $code, int $articleId, string $tag)
    {
        //todo check $tag for integrity

        $articleTag = ArticleTag::with('tags')
            ->where('article_id', $articleId)
            ->whereHas('tags', function ($query) use ($tag) {
                $query->where('name', $tag);
            });

        $articleTag->delete();

        return new ArticleResource(Article::find($articleId));
    }
}
