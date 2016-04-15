<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Review;
use App\Movie;
use App\Image;
use App\Library\StaticData;
use Image as InterventionImage;
use ImageSync;

class WelcomeController extends Controller
{
    //Display home page
    public function display()
    {
        $reviews = Review::orderBy('created_at', 'dsc')->get()->slice(0, 3);

        //add user avatars to reviews
        foreach($reviews as $review)
        {
            $reviewerAvatarId = $review->user()->firstOrFail()->avatar;
            $reviewerAvImage = Image::where('id', '=', $reviewerAvatarId)->first();
            $reviewerAvatar = $reviewerAvImage['path'].'/'.$reviewerAvImage['name'].'.'.$reviewerAvImage['extension'];
            if($reviewerAvatar == '/.'){
                $reviewerAvatar = StaticData::defaultAvatar();
            }
            $review->avatar = $reviewerAvatar;
        }

       //$top10 = Movie::orderBy('rating', 'dsc')->get()->slice(0,10);
        $recentmovie = Movie::orderBy('created_at', 'dsc')->get()->slice(0,10);

        return view('welcome')->with([
            'reviews' => $reviews,

            'recentmovie' => $recentmovie
        ]);
    }
}
