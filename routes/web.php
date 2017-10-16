<?php



Route::get('/', function () {
    return view('welcome');
});

Route::resource('subscribe', 'SubscriberController');

Route::get('/impression', 'ImpressionController@impression');


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

