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

    Route::get('/userpage/home', 'HomeController@index');
    Route::get('/userpage/createList', 'HomeController@createList');
    Route::post('/userpage/createList', 'HomeController@storeList');

    Route::get('/admin/adminDash', 'AdminController@index');

    Route::get('/', function() {
        return view('welcome');
    });

    Route::get('/search/movie', 'SearchController@advancedMovie');
    Route::get('/search/person', 'SearchController@advancedPerson');
});
