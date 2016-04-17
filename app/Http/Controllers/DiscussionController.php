<?php

namespace App\Http\Controllers;

use Auth;
use App\Movie;
use App\Discussion;
use App\Reply;
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
        $discussions = new Discussion;

        $discussions->movie_id = $movie_id;
        $discussions->user_id = Auth::user()->id;
        $discussions->title = Input::get('title');
        $discussions->body = Input::get('body');

        $discussions->save();

        return redirect()->action('DiscussionController@display', $discussions->id);

    }


    /*
     * Used to display discussion page.
     * Launches view of discussion page.
     */
    public function display($discussion_id)
    {
        $discussions = Discussion::where('id', $discussion_id)->first();

        $movieTitle = Movie::where('id', $discussions->movie_id)->first()->title;

        $replies = Reply::where('discussion_id', $discussion_id)->orderBy('created_at', 'asc')->get();

        return view('discussions.display')->with([
            'discussion' => $discussions,
            'movieTitle' => $movieTitle,
            'replies' => $replies
        ]);
    }

    /*
     * Used to display new reply page.
     * Launches view to original post with empty reply box form.
    */
    public function newReply($discussion_id)
    {
        return view('discussions.newReply')->with('discussion_id', $discussion_id);
    }

    /*
     * Posts a reply created in the newReply view.The reply
     * is added to the database. Redirects to display the discussion post
     * associated with discussion_id.
     */
    public function postReply($discussion_id)
    {
        $reply = new Reply;
        $reply->discussion_id = $discussion_id;
        $reply->user_id = Auth::user()->id;
        $reply->body = Input::get('body');
        $reply->save();

        return redirect()->action('DiscussionController@display', $discussion_id);
    }






}