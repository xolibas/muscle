<?php
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'Cabinet\HomeController@index')->name('home');
Route::group(
    [
        'prefix'=>'admin',
        'as'=>'admin.',
        'namespace'=>'Admin',
        'middleware'=>['auth'],
    ],
    function(){
        Route::get('/','HomeController@index')->name('home');
        Route::resource('users','UsersController');
    }
);
