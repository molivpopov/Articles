<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
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
            'image' => 'required|image|max:2000'
        ]);

        $path = Storage::putFile('public/' . $articleId, $valid['image']);

        Image::create([
            'article_id' => $articleId,
            'link' => $path,
            'name' => $valid['image']->getClientOriginalName()
        ]);

        return new ArticleResource(Article::find($articleId));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $code
     * @param int $imageId
     * @return ArticleResource
     */
    public function destroy(string $code, int $imageId)
    {
        //todo check $imageId for integrity
        $image = Image::with('article')->find($imageId);

        $articleId = $image->article->id;

        Storage::delete($image->link);

        $image->delete();

        return new ArticleResource(Article::find($articleId));
    }
}
