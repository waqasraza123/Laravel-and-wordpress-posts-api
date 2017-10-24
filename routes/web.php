<?php



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
    try {
        $response = $fb->get('/me?fields=id,name,email', 'user-access-token');
    } catch(\Facebook\Exceptions\FacebookSDKException $e) {
        dd($e->getMessage());
    }

    $userNode = $response->getGraphUser();
    printf('Hello, %s!', $userNode->getName());

});

Route::post('dropzone/store', ['as'=>'dropzone.store','uses'=>'MediaController@dropzoneStore']);


Route::get('/events/go', 'PagesController@goEventAction')->name('events.go');
Route::get('/events/pixel', 'PagesController@pixelAction')->name('events.pixel');