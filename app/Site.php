<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'sites';

    public function posts(){
        return $this->belongsToMany(Post::class, 'post_site', 'site_id', 'post_id');
    }

}
