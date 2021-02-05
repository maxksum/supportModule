<?php

Route::group(['prefix' => 'user', 'middleware' => 'web', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
  Route::get('login', 'LoginController@login')->name("login");
  Route::get('/auth/steam', 'LoginController@handle')->name("steamauth");


  Route::get('/{id}', 'UserController@show');

  Route::group(['middleware' => ['auth']], function () {
      Route::post('logout', 'LoginController@logout');

      Route::get('/', 'UserController@show');
      Route::post('tradelink', 'UserController@editTrade');
      Route::post('about', 'UserController@editAbout');
  });

  Route::get('/vkauth', 'VkAuthController@index');
});
