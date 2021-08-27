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


?>