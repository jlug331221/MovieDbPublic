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
    Route::post('/userpage/home/addToList', 'HomeController@postAddToList');
    Route::post('/userpage/home/newList', 'HomeController@postList');
    Route::get('/userpage/home/deleteList/{mlid}', 'HomeController@deleteList');
    Route::get('/userpage/avatar', 'HomeController@avatar');
    Route::post('/userpage/avatar/store', 'HomeController@store');

    // Admin Routes
    Route::get('/admin/adminHome', 'AdminController@index');
    Route::get('/admin/showAllMovies', 'AdminController@showMovies');
    Route::get('admin/showMovie/{id}', 'AdminController@showMovie');
    Route::put('admin/updateMovie/{id}', 'AdminController@updateMovie');
    Route::get('admin/deleteMovie/{id}', 'AdminController@destroyMovie');
    Route::get('/admin/showAllPeople', 'AdminController@showPeople');
    Route::get('/admin/showPerson/{id}', 'AdminController@showPerson');
    Route::put('/admin/updatePerson/{id}', 'AdminController@updatePerson');
    Route::get('/admin/deletePerson/{id}', 'AdminController@destroyPerson');
    Route::get('/admin/createMovie', 'AdminController@createMovie');
    Route::post('/admin/createMovie', 'AdminController@storeMovie');
    Route::get('/admin/createPerson', 'AdminController@createPerson');
    Route::post('/admin/createPerson', 'AdminController@storePerson');

    Route::get('/', function() { return view('welcome'); });

    // Search Routes
    Route::get('/search', 'SearchController@get_basicSearch');
    Route::post('/search', 'SearchController@post_basicSearch');
    Route::get('/search/movie', 'SearchController@get_advancedMovie');
    Route::post('/search/movie', 'SearchController@post_advancedMovie');
    Route::get('/search/person', 'SearchController@get_advancedPerson');
    Route::post('/search/person', 'SearchController@post_advancedPerson');
    Route::get('/search/jsonTest', 'SearchController@get_jsonTest'); // temp
    Route::get('/search/suffix/{term}', 'SearchController@get_suffixSearch_json');
    Route::post('/search/suffix', 'SearchController@post_suffixSearch_json');

    // Review Routes
    Route::get('/reviews/create/{mid}', 'ReviewController@create');
    Route::post('/reviews/submit/{mid}', 'ReviewController@submit');
    Route::get('/reviews/display/{rid}', 'ReviewController@display');
    Route::post('/reviews/newcomment/{rid}', 'ReviewController@newComment');
    Route::post('/reviews/postcomment/{rid}', 'ReviewController@postComment');
    Route::get('/reviews/handleVote/{vote}{rid}', 'ReviewController@handleVote');
    Route::get('/reviews/test/', 'ReviewController@testComponent');

    // Image Routes
    Route::get('/images/create', 'ImagesController@create');
    Route::post('/images/store', 'ImagesController@store');
    Route::get('/images/delete/{name}', 'ImagesController@delete');
    Route::get('/images/discard/{name}', 'ImagesController@discard');

    //Movie page routes
    Route::get('/movies/movie', 'MoviePageController@moviePage');

    //Person page routes
    Route::get('/people/person', 'PersonPageController@personPage');
});
