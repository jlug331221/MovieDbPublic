<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Movie;

class MoviesController extends Controller
{
    public function allmovies()
    {
        $movies = Movie::all();
        //return view('allmovies', compact('movies'));
        //return Movie::all();
    }
}
