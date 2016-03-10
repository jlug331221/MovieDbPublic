<?php

namespace App\Http\Controllers;

use App\Library\StaticData;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
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
