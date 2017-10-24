<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function topics()
    {
        return $this->belongsToMany(Topic::class,  'post_topic', 'post_id', 'topic_id');
    }
}
