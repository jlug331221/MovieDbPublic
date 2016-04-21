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
    Route::post('/userpage/home/newList', 'HomeController@postList');
    Route::get('/userpage/home/deleteList/{mlid}', 'HomeController@deleteList');
    Route::get('/userpage/avatar', 'HomeController@avatar');
    Route::post('/userpage/avatar/store', 'HomeController@store');
    Route::get('/userpage/home/addToList/{id}/{lid}', 'HomeController@postAddToList');

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
    Route::get('/admin/removeCastCrew/{pid}/{mid}/{cTypeId}', 'AdminController@removeCastCrew');
    Route::get('/admin/createMovie', 'AdminController@createMovie');
    Route::post('/admin/createMovie', 'AdminController@storeMovie');
    Route::get('/admin/createPerson', 'AdminController@createPerson');
    Route::post('/admin/createPerson', 'AdminController@storePerson');
    Route::get('/admin/createCharacter', 'AdminController@showCreateCharacterForm');
    Route::post('/admin/createCharacter', 'AdminController@storeCharacter');
    Route::get('/admin/showAllCharacters', 'AdminController@showCharacters');
    Route::get('/admin/showCharacter/{id}', 'AdminController@showCharacter');
    Route::put('/admin/updateCharacter/{id}', 'AdminController@updateCharacter');
    Route::get('/admin/deleteCharacter/{id}', 'AdminController@destroyCharacter');
    Route::get('/admin/showAllPeopleForCastCrewSelection/{mid}', 'AdminController@showAllPeopleForCastCrewSelection');
    Route::get('/admin/showAllCharactersForCastSelection/{pid}&{mid}',
                'AdminController@showAllCharactersForCastSelection');
    Route::get('/admin/addCastMember/{pid}&{mid}&{cid}', 'AdminController@addCastMember');
    Route::get('/admin/showAddCrewMemberForm/{pid}&{mid}', 'AdminController@showAddCrewMemberForm');
    Route::post('/admin/showAddCrewMemberForm/{pid}&{mid}', 'AdminController@storeCrewMember');

    Route::get('/', 'WelcomeController@display');

    // Search Routes
    Route::get('/search', 'SearchController@get_basicSearch');
    Route::post('/search', 'SearchController@post_basicSearch');
    Route::get('/search/movie', 'SearchController@get_advancedMovie');
    Route::post('/search/movie', 'SearchController@post_advancedMovie');
    Route::get('/search/person', 'SearchController@get_advancedPerson');
    Route::post('/search/person', 'SearchController@post_advancedPerson');
    Route::get('/search/json/{term}', 'SearchController@get_suffixSearch_json');

    // Review Routes
    Route::get('/reviews/create/{mid}', 'ReviewController@create');
    Route::post('/reviews/submit/{mid}', 'ReviewController@submit');
    Route::get('/reviews/display/{rid}', 'ReviewController@display');
    Route::post('/reviews/newcomment/{rid}', 'ReviewController@newComment');
    Route::post('/reviews/postcomment/{rid}', 'ReviewController@postComment');
    Route::get('/reviews/handleVote/{vote}{rid}', 'ReviewController@handleVote');
    Route::get('/reviews/test/', 'ReviewController@testComponent');
    Route::get('/reviews/delete/{rid}', 'ReviewController@deleteReview');
    Route::get('/reviews/deleteComment/{cid}', 'ReviewController@deleteComment');

    // Image Routes
    Route::post('/images/storeMovieImage/{mid}', 'ImagesController@storeMovieImage');
    Route::post('/images/storePersonImage/{pid}', 'ImagesController@storePersonImage');
    Route::get('/images/destroyMovieImage/movie/{mid}/image/{imgId}', 'ImagesController@destroyMovieImage');
    Route::get('/images/destroyPersonImage/person/{pid}/image/{imgId}', 'ImagesController@destroyPersonImage');
    Route::get('/album/movie/{id}', 'ImagesController@get_movieAlbum');
    Route::get('/album/person/{id}', 'ImagesController@get_personAlbum');
    Route::get('/album/json/{id}', 'ImagesController@get_album_json');

    //Movie page routes
    Route::get('/movies/{id}', 'MoviePageController@showMovie');

    //Person page routes
    Route::get('/people/{id}', 'PersonPageController@showPerson');

    //Discussion routes
    Route::get('/discussions/create/{mid}', 'DiscussionController@create');
    Route::post('/discussions/submit/{mid}', 'DiscussionController@submit');
    Route::get('/discussions/display/{rid}', 'DiscussionController@display');
    Route::post('/discussions/newreply/{rid}', 'DiscussionController@newReply');
    Route::post('/discussions/postreply/{rid}', 'DiscussionController@postReply');

});
