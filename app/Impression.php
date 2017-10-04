<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SammyK\LaravelFacebookSdk\SyncableGraphNodeTrait;

class Impression extends Model
{
    use SyncableGraphNodeTrait;

    protected $fillable = ['value'];
    protected static $graph_node_fillable_fields = ['value'];
    protected static $graph_node_date_time_to_string_format = 'c'; # ISO 8601 date

//    protected static $graph_node_field_aliases = [
//        'country_page_likes' => 'value',
//        'id' => 'faceid'
//
//    ];


    protected static $graph_node_field_aliases = [
        'id' => 'faceid',
        'values.value' => 'value',
    ];


}
