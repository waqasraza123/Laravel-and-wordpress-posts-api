<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'email', 'status'
    ];

    public function topics(){
        return $this->belongsToMany('App\Topic');
    }


}
