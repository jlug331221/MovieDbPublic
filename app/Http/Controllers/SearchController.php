<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Movie;
use App\Person;
use App\Library\StaticData;
use App\Http\Requests;
use App\Http\Requests\AdvancedMovieRequest;
use App\Http\Requests\AdvancedPersonRequest;
use App\Http\Controllers\Controller;


class SearchController extends Controller {

    public function get_basicSearch()
    {
	   return view('search.searchPage');
    }

    public function post_basicSearch(Request $request)
    {
        $queryString = $request->get('search');
        $movies = Movie::where('title', 'LIKE', $queryString)->get();
	$people = Person::where('first_name', 'LIKE', $queryString)->get();
        if (count($movies) == 0)
            $movies = Movie::all();
	if (count($people) == 0)
	    $people = Person::all();
        return view('search.searchPage', compact('movies', 'people'));
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
        $params = [
            'name'        => $request->input('name'),
            'genre'       => $request->input('genre'),
            'date-start'  => $request->input('date-start'),
            'date-end'    => $request->input('date-end'),
            'countries'   => $request->input('countries'),
            'rating'      => $request->input('rating'),
            'runtime-min' => $request->input('runtime-min'),
            'runtime-max' => $request->input('runtime-max'),
            'keyword'     => $request->input('keyword'),
        ];

        $movies = DB::table('movies');
        if ($params['name']) {
            $movies->whereIn('id', function ($query) use ($params) {
                $query->select('movie_id')
                    ->from('movie_suffixes')
                    ->whereRaw("title_suffix LIKE '" . $params['name'] . "%'");
            });
        }
        if ($params['genre']) {
            $movies->whereIn('genre', $params['genre']);
        }
        if ($params['date-start']) {
            $date_start = date('Y-m-d', strtotime($params['date-start']));
            $movies->where('release_date', '>', $date_start);
        }
        if ($params['date-end']) {
            $date_end = date('Y-m-d', strtotime($params['date-end']));
            $movies->where('release_date', '<', $date_end);
        }
        if ($params['countries']) {
            $movies->whereIn('country', $params['countries']);
        }
        if ($params['rating']) {
            $movies->whereIn('parental_rating', $params['rating']);
        }
        if ($params['runtime-min']) {
            $movies->where('runtime', '>', $params['runtime-min']);
        }
        if ($params['runtime-max']) {
            $movies->where('runtime', '<', $params['runtime-max']);
        }
        if ($params['keyword']) {
            $keywords = preg_replace("/[^A-Za-z0-9 ]/", '', $params['keyword']);
            $movies->whereIn('id', function ($query) use ($keywords) {
                $query->select('id')
                    ->from('movies')
                    ->whereRaw("MATCH(title, synopsis) AGAINST('$keywords')");
            });
        }

        $movies = $movies->get();
        return view('search.search', compact('movies'));
    }

    public function get_advancedPerson()
    {
        $countries = StaticData::$countries;
        return view('search.advperson', compact('countries'));
    }

    public function post_advancedPerson(AdvancedPersonRequest $request)
    {
        $params = [
            'name'                => $request->input('name'),
            'date-of-birth-start' => $request->input('date-of-birth-start'),
            'date-of-birth-end'   => $request->input('date-of-birth-end'),
            'date-of-death-start' => $request->input('date-of-death-start'),
            'date-of-death-end'   => $request->input('date-of-death-end'),
            'countries'           => $request->input('countries'),
            'keyword'             => $request->input('keyword'),
        ];

        return explode(' ', $params['name']);
    }

    public function post_suffixSearch_json(Request $request)
    {
        // get search term and remove non-alpha-numeric characters
        $term = $request->get('term');
        $term = preg_replace("/[^A-Za-z0-9 ]/", '', $term);

        // get id, title, and release date for movies where the
        // search term matches a movie title suffix
        return DB::table('movies')
            ->select('id', 'title', 'release_date')
            ->whereIn('id', function ($query) use ($term) {
                $query->select('movie_id')
                    ->from('movie_suffixes')
                    ->whereRaw("title_suffix LIKE '" . $term . "%'");
            })
            ->get();
    }

    public function get_suffixSearch_json($term)
    {
        // get search term and remove non-alpha-numeric characters
        $term = preg_replace("/[^A-Za-z0-9 ]/", '', $term);
        
        return DB::table('movies')
            ->select('movies.title AS title', 
                'movies.id',
                'movies.release_date AS date',
                'images.name AS imgname', 
                'images.path AS imgpath', 
                'images.extension AS imgext')
            ->distinct('movies.id')
            ->join('albums', 'movies.album', '=', 'albums.id')
            ->leftJoin('images', 'albums.default', '=', 'images.id')
            ->join('movie_suffixes', function ($join) use ($term) { 
                $join->on('movies.id', '=', 'movie_suffixes.movie_id')
                     ->where('movie_suffixes.title_suffix', 'LIKE', $term.'%'); 
            })
            ->get(); 
    }
}









