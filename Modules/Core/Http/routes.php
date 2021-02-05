<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Core\Http\Controllers'], function()
{
    Route::get('/', 'CoreController@index');
    Route::get('/test', 'CoreController@test');
    Route::get('/core/login', 'CoreController@loginLocal');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/report', 'CoreController@showUserReport');
    });
});

Route::get('refresh-csrf', function () {
    return csrf_token();
});
