<?php

namespace App\Http\Controllers;

use Auth;
use App\Movie;
use App\Review;
use App\Comment;
use App\Vote;
use App\Masterlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Library\StaticData;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Image;
use DB;
use Image as InterventionImage;
use ImageSync;
class ReviewController extends Controller
{
    /*
     * Used to create a new review. The review must be passed a movie id.
     * Launches view with a form to create a new review.
     */
    public function create($movie_id)
    {
        if(!Auth::check())
        {
            return redirect()->action('WelcomeController@display');
        }

        $review = Review::where('user_id', Auth::user()->id)->where('movie_id', $movie_id)->first();
        if(!empty($review))
        {
            return redirect()->action('ReviewController@display', $review->id);
        }

        $movie = Movie::where('id', $movie_id)->first();
        $movie = Movie::get();

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

        /*$avatar_id = Auth::user()->avatar;
        $av_image = Image::where('id', '=' ,$avatar_id)->first();
        $avatar = $av_image['path'].'/'.$av_image['name'].'.'.$av_image['extension'];
        if($avatar == '/.'){
            $avatar = StaticData::defaultAvatar();
        }*/

        //Get review owners avatar
        $reviewerAvatarId = $review->user()->firstOrFail()->avatar;
        $reviewerAvImage = Image::where('id', '=', $reviewerAvatarId)->first();
        $reviewerAvatar = $reviewerAvImage['path'].'/'.$reviewerAvImage['name'].'.'.$reviewerAvImage['extension'];
        if($reviewerAvatar == '/.'){
            $reviewerAvatar = StaticData::defaultAvatar();
        }
        $review->avatar = $reviewerAvatar;

        //Get comment avatars
        foreach($comments as $comment)
        {
            $commentAvatarId = $comment->user()->firstOrFail()->avatar;
            $commentAvImage = Image::where('id', '=', $commentAvatarId)->first();
            $commentAvatar = $commentAvImage['path'].'/'.$commentAvImage['name'].'.'.$commentAvImage['extension'];
            if($commentAvatar == '/.'){
                $commentAvatar = StaticData::defaultAvatar();
            }
            $comment->avatar = $commentAvatar;
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

    /*
     * Handles ajax request for a vote. The voe value is stored in vote, the reviewId is stored in rId.
     * Adds, deletes, or changes a vote based on what information is currently stored in the databse for the
     * current user.
     */
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

    //Deletes the review specified by $rid from the database
    //Also deletes any comments or votes associated with that review
    public function deleteReview($rId)
    {
        $review = Review::where('id', $rId)->first();

        if(Auth::user()->id === $review->user_id || Auth::user()->hasRole(['Comment Moderator', 'Review Moderator']))
        {
            $comments = Comment::where("review_id", $rId)->get();

            foreach($comments as $comment)
            {
                $comment->delete();
            }

            $votes = Vote::where('review_id', $rId)->get();

            foreach($votes as $vote)
            {
                $vote->delete();
            }

            $review->delete();
        }
    }

    //Deletes the comment specified by cId from the database
    public function deleteComment($cId)
    {
        $comment = Comment::where('id', $cId)->first();

        if($comment->user_id == Auth::user()->id)
        {
            $comment->delete();
        }
    }
}