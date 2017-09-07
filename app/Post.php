<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Conner\Tagging\Taggable;

class Post extends Model
{
    use Taggable;
    protected $table = 'posts';
}
