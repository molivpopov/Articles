<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Article;
use App\Models\Comment;
use App\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $code
     * @param int $articleId
     * @return CommentResource
     */
    public function store(Request $request, string $code, int $articleId)
    {
        $article = Article::find($articleId);

        $comment = $request->validate([
            'comment' => 'required|string'
        ])['comment'];

        $userId = User::where('uuid', $code)
            ->first()
            ->id;

        $newComment = Comment::create([
            'user_id' => $userId,
            'comment' => $comment
        ]);

        return new CommentResource($newComment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $code
     * @param int $commentId
     * @return CommentResource
     */
    public function update(Request $request, string $code, int $commentId)
    {
        $oldComment = Comment::with('user')->find($commentId);

        if(!$oldComment)
            abort(404);

        if($oldComment->user->role != 'admin' && !$oldComment->user($code)->first())
            abort(403);

        $valid = $request->validate([
            'comment' => 'required|string'
        ]);

        return new CommentResource($oldComment->update($valid));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $code
     * @param int $commentId
     * @return CommentResource
     */
    public function destroy(string $code, int $commentId)
    {
        $oldComment = Comment::with('user')->find($commentId);

        if(!$oldComment)
            abort(404);

        if($oldComment->user->role != 'admin' && !$oldComment->user($code)->first())
            abort(403);

        $resourceToReturn = new CommentResource($oldComment);

        $oldComment->delete();

        return $resourceToReturn;
    }
}
