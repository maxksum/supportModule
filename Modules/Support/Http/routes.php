<?php

Route::group(['middleware' => 'web', 'prefix' => 'support', 'namespace' => 'Modules\Support\Http\Controllers'], function()
{
    Route::get('/', 'SupportController@index');
    Route::get('/{id}', 'SupportController@index');
    Route::post('/addticket', 'SupportController@addNewTicket');
    Route::post('/addmessage', 'SupportController@addNewTicketMessage');
    Route::post('/changestate', 'SupportController@changeTicketState');
    Route::post('/showticket', 'SupportController@showTicket');
    Route::post('/changestate/{id}', 'SupportController@changeTicketState');
    Route::post('/upload_file', 'SupportController@uploadFile');
    Route::post('/searchusers', 'SupportController@searchUsers');
    Route::post('/addadminmessage', 'SupportController@addNewTicketAdminMessage');
    Route::post('/voteforcheats', 'SupportController@voteForCheats');
    Route::post('/addtoparticipants', 'SupportController@addUserToParticipants');
    Route::post('/checkroute', 'SupportController@checkRoute');
    Route::post('/', 'SupportController@index');
});
