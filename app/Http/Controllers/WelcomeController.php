<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Review;
use App\Movie;

class WelcomeController extends Controller
{
    //Display home page
    public function display()
    {
        $reviews = Review::orderBy('created_at', 'dsc')->get()->slice(0, 3);
       //$top10 = Movie::orderBy('rating', 'dsc')->get()->slice(0,10);
        $recentmovie = Movie::orderBy('created_at', 'dsc')->get()->slice(0,10);

        return view('welcome')->with([
            'reviews' => $reviews,

            'recentmovie' => $recentmovie
        ]);
    }
}
