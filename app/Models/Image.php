<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $table = 'images';

    protected $guarded = ['id'];

    public $timestamps = false;

    public function article()
    {
        return $this->hasOne(Article::class, 'id', 'article_id');
    }
}
