<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $table = 'tags';

    protected $guarded = ['id'];

    public $timestamps = false;
}
