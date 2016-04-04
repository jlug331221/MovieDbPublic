<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Review;

class WelcomeController extends Controller
{
    //Display home page
    public function display()
    {
        $reviews = Review::orderBy('created_at', 'dsc')->get()->slice(0, 3);

        return view('welcome')->with([
            'reviews' => $reviews
        ]);
    }
}
