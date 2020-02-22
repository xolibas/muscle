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
        'middleware'=>['auth','can:admin-panel'],
    ],
    function(){
        Route::get('/','HomeController@index')->name('home');
        Route::resource('users','UsersController');
        Route::resource('exercises','ExercisesController');
        Route::resource('programs','ProgramsController');
       // Route::post('exercises.imageLoad','ExercisesController@imageLoad')->name('exercises.imageLoad');
    }
);
