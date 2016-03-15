<?php

namespace App\Http\Controllers;

use App\Library\StaticData;
use App\Http\Requests\AdvancedMovieRequest;
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

    public function advancedMovieQuery(AdvancedMovieRequest $request)
    {
        $inputs = [
            'name' => $request->input('name'),
            'genre' => $request->input('genre'),
            'date-start' => $request->input('date-start'),
            'date-end' => $request->input('date-end'),
            'countries' => $request->input('countries'),
            'rating' => $request->input('rating'),
            'runtime-min' => $request->input('runtime-min'),
            'runtime-max' => $request->input('runtime-max'),
            'keyword' => $request->input('keyword'),
        ];
        return $inputs;
    }

    public function advancedPerson()
    {
        return view('search.advperson');
    }
}
