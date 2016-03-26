<?php

namespace App\Http\Controllers;

use Auth;
use App\Movie;
use App\Review;
use App\Comment;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
class ReviewController extends Controller
{
    /*
     * Used to create a new review. The review must be passed a movie id.
     * Launches view with a form to create a new review.
     */
    public function create($movie_id)
    {
        $movie = Movie::where('id', $movie_id)->first();

        //If no matching movie is found, show not found page
        if(empty($movie))
        {
            return view('reviews.notFound')->with('missing', 'movie');
        }

        return view('reviews.create')->with('movie_id', $movie_id);
    }

    /*
     * Adds the review created from a review form to the database.
     * Redirects to display the newly created review.
     */
    public function submit($movie_id)
    {
        $review = new Review;
        $review->title = Input::get('title');
        $review->body = Input::get('body');
        $review->movie_id = $movie_id;
        $review->user_id = Auth::user()->id;
        $review->rating = Input::get('rating');
        $review->score = 0;
        $review->save();

        return redirect()->action('ReviewController@display', $review->id);
    }

    /*
     * Displays the review specified by review_id. The comments associated
     * with the review are displayed below it in ascending order based on the
     * time they were posted.
     */
    public function display($review_id)
    {
        $review = Review::where('id', $review_id)->first();

        //If no review found, display not found page
        if(empty($review))
        {
            return view('reviews.notFound')->with('missing', 'review');
        }

        $movieTitle = Movie::where('id', $review->movie_id)->first()->title;

        $comments = Comment::where('review_id', $review_id)->orderBy('created_at', 'asc')->get();

        //Voted stores the value of whether the user voted up or down
        if(Auth::check())
        {
            $voted = Vote::where('user_id', Auth::user()->id)->where('review_id', $review_id)->first();

            if(empty($voted))
            {
                $voted = 0;
            }
            else
            {
                $voted = $voted->vote;
            }
            $logged = 1;
        }
        else
        {
            $voted = -99;
            $logged = 0;
        }


        return view('reviews.display')->with([
            'review' => $review,
            'movieTitle' => $movieTitle,
            'comments' => $comments,
            'voted' => $voted,
            'logged' => $logged
        ]);
    }

    /*
     * launches the view to create a new comment for the review with
     * id review_id.
     */
    public function newComment($review_id)
    {
        return view('reviews.newComment')->with('review_id', $review_id);
    }

    /*
     * Posts a comment created in the newComment view.The comment
     * is added to the database. Redirects to display the review
     * associated with review_id.
     */
    public function postComment($review_id)
    {
        $comment = new Comment;
        $comment->review_id = $review_id;
        $comment->user_id = Auth::user()->id;
        $comment->body = Input::get('body');
        $comment->save();

        return redirect()->action('ReviewController@display', $review_id);
    }

    public function handleVote($vote, $rId)
    {
        $review = Review::where('id', $rId)->first();

        if($vote == 0)
        {
            //If user is undoing their vote
            $vote = Vote::where("user_id", Auth::user()->id)->where("review_id", $rId)->first();
            $review->score -= $vote->vote;
            $vote->delete();
            $review->save();
        }
        else if($vote == -1)
        {
            //If user is downvoting for the first time
            $newVote = new Vote;
            $newVote->user_id = Auth::user()->id;
            $newVote->review_id = $rId;
            $newVote->vote = $vote;
            $newVote->save();

            $review->score += $vote;
            $review->save();
        }
        else if($vote == -2)
        {
            //If user previously upvoted, but is now downvoting.

            //Delete previous upvote
            $vote = Vote::where("user_id", Auth::user()->id)->where("review_id", $rId)->first();
            $vote->delete();

            //Create new downvote, set score accordingly.
            $newVote = new Vote;
            $newVote->user_id = Auth::user()->id;
            $newVote->review_id = $rId;
            $newVote->vote = -1;
            $newVote->save();
            $review->score += -2;
            $review->save();
        }
        else if($vote == 1)
        {
            //Upvoting without having previously voted
            $newVote = new Vote;
            $newVote->user_id = Auth::user()->id;
            $newVote->review_id = $rId;
            $newVote->vote = $vote;
            $newVote->save();

            $review->score += $vote;
            $review->save();
        }
        else if($vote == 2)
        {
            //Upvoting after downvoting

            //Delete previous downvote
            $vote = Vote::where("user_id", Auth::user()->id)->where("review_id", $rId)->first();
            $vote->delete();

            $newVote = new Vote;
            $newVote->user_id = Auth::user()->id;
            $newVote->review_id = $rId;
            $newVote->vote = 1;
            $newVote->save();

            $review->score += 2;
            $review->save();
        }


    }

    public function testComponent()
    {
        $rId = 1;

        $review = Review::where('id', $rId)->first();

        return view('reviews.componentTest')->with(['review' => $review]);
    }
}