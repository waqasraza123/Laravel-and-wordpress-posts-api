<?php

Route::get('/clear_cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    return "Cache Cleared!";
});

Route::get('/', function () {
    return view('welcome');
});

Route::resource('subscribe', 'SubscriberController');

Route::get('/impression', 'ImpressionController@impression');

Route::get('/admin/newsletter/send/{type}', ['uses' => 'NewsletterSendController@indexAction']);

Route::resource('media', 'MediaController');
Route::get('/upload', 'MediaController@create');


Route::get('/doug', function(){
    return view('subscribe.doug');
});

Route::get('/admin/stats', 'PagesController@stats');
Route::get('/admin/details', 'PagesController@details')
    ->name('stats.details');

Route::get('/doug', function(){
    return view('subscribe.doug');
});


Route::get('/test', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
    echo \Carbon\Carbon::now()->format('d-m-Y');
});

Route::post('dropzone/store', ['as'=>'dropzone.store','uses'=>'MediaController@dropzoneStore']);


Route::get('/events/go', 'PagesController@goEventAction')->name('events.go');
Route::get('/events/pixel', 'PagesController@pixelAction')->name('events.pixel');

Route::get('waqas', 'PostsHandlerController@uploadImage');
Route::get('/posts', 'AdminPostsController@getWpPosts');