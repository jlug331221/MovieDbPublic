<?php

namespace App\Http\Controllers;

use Auth;
use App\Movie;
use App\Review;
use App\Comment;
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

        $movieTitle = Movie::where('id', $review->movie_id)->first()->title;

        $comments = Comment::where('review_id', $review_id)->orderBy('created_at', 'asc')->get();

        return view('reviews.display')->with([
            'review' => $review,
            'movieTitle' => $movieTitle,
            'comments' => $comments
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
}