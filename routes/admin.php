<?php

Route::get('Admin',  function(){
    return redirect()->route('admin.login');
});

Route::group(['namespace' => 'Auth'], function(){
    # Login Routes
    Route::get('login',     'LoginController@showLoginForm')->name('login');
    Route::post('login',    'LoginController@login');
    Route::post('logout',   'LoginController@logout')->name('logout');

});

Route::group(['middleware' => 'auth:admin'],function (){

    Route::group(['prefix' => 'user', 'as' => 'user.'],function (){

        Route::get('list',                     'UserController@index')->name('list');
        Route::get('view',                     'UserController@view')->name('view');
        Route::post('create',                  'UserController@store')->name('create');
        Route::get('country-state-city',       'UserController@country')->name('country-state-city');
        Route::post('get-states-by-country',   'UserController@getState')->name('get-states-by-country');
        Route::post('get-cities-by-state',     'UserController@getCity')->name('get-cities-by-state');
        Route::post('check',                   'UserController@check')->name('check');
        Route::post('checkk',                  'UserController@checkk')->name('checkk');
        Route::get('add',                      'UserController@view')->name('add');
        Route::get('test1/{id}',               'UserController@test1')->name('test1');
        Route::post('update',                  'UserController@update')->name('update');



    });

});
?>