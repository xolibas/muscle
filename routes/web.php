<?php
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/cabinet/home', 'Cabinet\HomeController@index')->name('cabinet.home');
Route::get('exercises', 'HomeController@exercises')->name('exercises');
Route::get('programs', 'HomeController@programs')->name('programs');
Route::get('nutritions', 'HomeController@nutritions')->name('nutritions');
Route::get('program/{program}', 'HomeController@program')->name('program');
Route::get('nutrition/{nutrition}', 'HomeController@nutrition')->name('nutrition');
Route::get('exercise/{exercise}', 'HomeController@exercise')->name('exercise');
Route::get('/cabinet/edit/{user}', 'Cabinet\HomeController@edit')->name('cabinet.edit');
Route::match(['put', 'patch'],'/cabinet/update/{user}', 'Cabinet\HomeController@update')->name('cabinet.update');
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
        Route::resource('days','DaysController');
        Route::resource('dayexercises','DayExercisesController');
        Route::resource('nutritions','NutritionsController');
        Route::resource('meals','MealController');
        Route::resource('mealproducts','MealProductsController');
        Route::resource('products','ProductsController');
    }
);
