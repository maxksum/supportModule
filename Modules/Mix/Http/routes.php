<?php
Route::group(['prefix' => 'mix', 'namespace' => 'Modules\Mix\Http\Controllers'], function () {
    Route::group(['prefix' => 'api', 'middleware' => 'api'], function () {
        Route::get('/{id}', 'MixController@json_data');
        Route::post('/match/{id}/init', 'MixController@seriesStart');
        Route::post('/match/{id}/finish', 'MixController@seriesFinish');
        Route::post('/match/{id}/map/{mapid}/start', 'MixController@mapStart');
        Route::post('/match/{id}/map/{mapid}/finish', 'MixController@mapFinish');
        Route::post('/match/{id}/map/{mapid}/update', 'MixController@updateState');
        Route::post('/match/{id}/map/{mapid}/player/{steam}/update', 'MixController@statsReceivePlayer');
    });

    Route::group(['middleware' => 'web'], function () {
        Route::group(['middleware' => ['role:administrator', 'auth']], function () {
            Route::get('/reset/{id}', 'MixController@reset');
        });
        Route::get('/list', 'MixController@mixespage');
        Route::get("/{id}", "MixController@showPage");
        Route::group(['middleware' => ['auth']], function () {
            Route::post("/{id}/report", 'MixController@playerReport');
            Route::post("/{id}/karma", 'MixController@karmaVote');
        });
    });
});

Route::group(['middleware' => ['web', 'auth'], 'prefix' => "lobby", 'namespace' => 'Modules\Mix\Http\Controllers'], function () {
    Route::get('/ready', 'LobbyController@ready');
    Route::post('/create', 'LobbyController@create');
    Route::post('/kick', 'LobbyController@kickPlayer');
    Route::post('/move', 'LobbyController@movePlayer');
    Route::post('/message', 'LobbyController@sendMessage');
    Route::post('/join', 'LobbyController@joinLobby');
    Route::group(['middleware' => ['role:administrator']], function () {
        Route::get('/reset', 'LobbyController@reset');
        Route::get('/reset/{id}', 'LobbyController@reset_id');
    });
});

