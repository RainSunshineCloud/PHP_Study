<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/redirect', function () {
    $query = http_build_query([
        'client_id' => '5',
        'redirect_uri' => 'http://wwww.test2.com/index',
        'response_type' => 'json',
        'scope' => 'qF5nqnWSDeCWseYQ4yYK46dTwueVdwyBLF4IXHNK',
    ]);

    return redirect('http://www.test.com/oauth/authorize?'.$query);
});



