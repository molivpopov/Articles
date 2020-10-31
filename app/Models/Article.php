<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $table = 'articles';

    protected $guarded = ['id'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, ArticleTag::class)
            ->orderBy('created_at', 'desc');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
