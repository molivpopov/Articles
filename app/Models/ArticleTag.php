<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    public $table = 'articles_tags';

    protected $guarded = ['id'];

    public $timestamps = false;

    public function tag()
    {
        return $this->hasOne(Tag::class, 'id', 'article_id');
    }
}
