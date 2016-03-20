<?php

namespace App\Http\Controllers;

use Request;
use App\Movie;
use App\Http\Requests\AdvancedMovieRequest;
use App\Person;
use App\Http\Requests\AdvancedPersonRequest;
use App\Library\StaticData;
use App\Http\Requests;
use App\Http\Controllers\Controller;


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

    public function get_advancedMovie()
    {
        $countries = StaticData::$countries;
        $genres = StaticData::$genres;
        $ratings = StaticData::$ratings;
        return view('search.advmovie', compact('countries', 'genres', 'ratings'));
    }

    public function post_advancedMovie(AdvancedMovieRequest $request)
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

    public function get_advancedPerson()
    {
        $countries = StaticData::$countries;
        return view('search.advperson', compact('countries'));
    }

    public function post_advancedPerson(AdvancedPersonRequest $request)
    {
        $inputs = [
            'name'                => $request->input('name'),
            'date-of-birth-start' => $request->input('date-of-birth-start'),
            'date-of-birth-end'   => $request->input('date-of-birth-end'),
            'date-of-death-start' => $request->input('date-of-death-start'),
            'date-of-death-end'   => $request->input('date-of-death-end'),
            'countries'           => $request->input('countries'),
            'keyword'             => $request->input('keyword'),
        ];
        return $inputs;
    }

    public function get_typeaheadDemo()
    {
        return view('search/typeaheadDemo');
    }
}
