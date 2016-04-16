<?php

namespace App\Http\Controllers;

use Auth;
use App\Movie;
use App\Discussion;
use App\Comment;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
class DiscussionController extends Controller
{
    /*
     * Used to create a new discussion.
     * Launches view with a form to create a new discussion.
     */
    public function create($movie_id)
    {
        $movie = Movie::where('id', $movie_id)->first();


        return view('discussions.create')->with('movie_id', $movie_id);
    }


    /*
     * Add discussion from discussion form to database.
     * Redirects to display new discussion.
     */
    public function submit($movie_id)
    {
        $discussions = new Discusssion;
        $discussions->title = Input::get('title');
        $discussions->body = Input::get('body');
        $discussions->movie_id = $movie_id;
        $discussions->user_id = Auth::user()->id;

        $discussions->save();

        return redirect()->action('DiscussionController@display', $discussions->id);

    }


    /*
     * Used to display discussion page.
     * Launches view of discussion page.
     */
    public function display($discussion_id)
    {
        $discussion = Review::where('id', $discussion_id)->first();

        $movieTitle = Movie::where('id', $discussion->movie_id)->first()->title;

        return view('reviews.display')->with([
            'review' => $discussion,
            'movieTitle' => $movieTitle,
        ]);
    }


    public function testComponent()
    {
        $dId = 1;

        $discussion = Discussion::where('id', $dId)->first();

        return view('discussions.discussionTest')->with(['discussion' => $discussion]);
    }



    /*
     * Used to display new comment page.
     * Launches view to original post with empty comment box form.

    public function newComment()
    {
        return view('discussions.newComment');
    }
    */
    /*
     * Submits discussion post to database.
     * Redirects to display page.
    public function submit($movie_id)
    {

    }

    public function postComment()
    {

    }
    
    public function deleteDiscussion()
    {

    }



    */




}