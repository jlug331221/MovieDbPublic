<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Movie;

class MoviePageController extends Controller
{
    public function moviePage()
    {
        return view('movies.movie');
    }
}