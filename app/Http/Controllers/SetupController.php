<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Image;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SetupController extends Controller
{
    public function set(Request $request)
    {
        $valid = $request->validate([
            'article_id' => 'nullable|exists:articles,id',
            'title' => 'required_without:article_id',
            'body' => 'nullable|string',
            'tag' => 'nullable|string',
            'image' => 'image|max:2000'
        ]);

        if ($request->has('article_id') && $valid['article_id']) {
            $article = Article::find($valid['article_id']);
            $article->title = $request->input('title', $article->title) ?? $article->title;
        } else {
            $article = Article::create([
                'title' => $request->input('title')
            ]);
        }

        $article->body = $request->input('body', $article->body) ?? $article->body;
        $article->save();

        if ($request->has('tag') && $valid['tag']) {

            $tag = Tag::updateOrCreate(
                ['name' => strtolower($valid['tag'])]
            );

            ArticleTag::updateOrCreate(
                ['tag_id' => $tag->id],
                ['article_id' => $article->id]
            );
        }

        if ($request->has('image') && $valid['image']) {
            $path = Storage::putFile('public/' . $article->id, $request->file('image'));
            Image::create([
                'article_id' => $article->id,
                'link' => $path,
                'name' => $request->file('image')->getClientOriginalName()
            ]);
        }

        return new ArticleResource($article);
    }

    public function deleteImage(Request $request)
    {
        $valid = $request->validate([
            // todo change this validation ???
            'image_id' => 'required|integer|exists:images,id',
            'article_id' => 'required|exists:articles,id'
        ]);

        $toDelete = Image::where('article_id', $valid['article_id'])
            ->find($valid['image_id']);

        //always have to delete
        $toDelete->delete();

        //todo also delete files from storage

        return response()->json(['data' => 'true']);
    }

    public function deleteTag(Request $request)
    {
        $valid = $request->validate([
            'tag' => 'required|string',
            'article_id' => 'required|exists:articles,id'
        ]);

        $toDelete = ArticleTag::with('tag')
            ->where('article_id', $valid['article_id'])
            ->whereHas('tag', function ($q) use ($valid) {
                $q->where('name', $valid['tag']);
            });

        if ($toDelete->count() > 0) {
            $toDelete->delete();
            return response()->json(['data' => 'true']);
        } else {
            return response()->json(['data' => 'false']);
        }
    }
}
