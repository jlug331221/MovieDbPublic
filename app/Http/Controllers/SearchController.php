<?php

namespace App\Http\Controllers;

use App\Library\StaticData;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Movie;
use Request;

class SearchController extends Controller
{
    public function index() 
    {
        return view('search.search');
    }

    public function basicSearch()
    {
	$queryString = Request::get('search');
	$movies = Movie::where('title', '=', $queryString)->get();
        if (count($movies) == 0)
            $movies = Movie::all();
        return view('search.search', compact('movies'));
    }

    public function advancedMovie()
    {
        $countries = StaticData::$countries;
        $genres = StaticData::$genres;
        $ratings = StaticData::$ratings;
        return view('search.advmovie', compact('countries', 'genres', 'ratings'));
    }

    public function advancedPerson()
    {
        return view('search.advperson');
    }
}
