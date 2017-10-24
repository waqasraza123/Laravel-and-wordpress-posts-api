<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function subscribers(){
        return $this->belongsToMany('App\Subscriber');
    }
}
