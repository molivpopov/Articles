<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $table = 'comments';

    protected $guarded = ['id'];

    public $timestamps = false;

    public function user($code = null)
    {
        $relation = $this->hasOne(User::class, 'id', 'user_id');

        return $code
            ? $relation->where('uuid', $code)
            : $relation;
    }

    public function article()
    {
        return $this->hasOne(Article::class, 'id', 'article_id');
    }
}
