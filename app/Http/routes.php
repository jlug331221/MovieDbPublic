<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('allmovies', 'MoviesController@allmovies');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::get('/admin/adminHome', 'AdminController@index');

    Route::get('/', function() {
        return view('welcome');
    });

    Route::get('/search/movie', 'SearchController@advancedMovie');
    Route::get('/search/person', 'SearchController@advancedPerson');

    //Review Routes
    Route::get('/reviews/create/{mid}', 'ReviewController@create');
    Route::post('/reviews/submit/{mid}', 'ReviewController@submit');
    Route::get('/reviews/display/{rid}', 'ReviewController@display');
    Route::post('/reviews/newcomment/{rid}', 'ReviewController@newComment');
    Route::post('/reviews/postcomment/{rid}', 'ReviewController@postComment');

});
