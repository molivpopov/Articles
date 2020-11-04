<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $isNotList = !$request->is('*/articles') || $request->method() != 'GET';

        return [
            'id' => $this->id,
            'header' => $this->title,
            'text' => $this->when($isNotList, $this->body),
            'tags' => TagResource::collection($this->tags),
            'images' => ImageResource::collection(
                $this->when($isNotList && $this->images->isNotEmpty(), $this->images)
            ),
            'comments' => CommentResource::collection(
                $this->when($isNotList && $this->comments->isNotEmpty(), $this->comments)
            ),
        ];
    }
}
