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
            $movies->join('movie_suffixes', function($join) use ($params) {
                $join->on('movies.id', '=', 'movie_suffixes.movie_id')
                    ->where('movie_suffixes.title_suffix', 'LIKE', $params['name'].'%');
            });
        }
        if ($params['genre']) {
            $movies->whereIn('genre', $params['genre']);
        }
        if ($params['date-start']) {
            $date_start = date('Y-m-d', strtotime($params['date-start']));
            $movies->where('release_date', '>=', $date_start);
        }
        if ($params['date-end']) {
            $date_end = date('Y-m-d', strtotime($params['date-end']));
            $movies->where('release_date', '<=', $date_end);
        }
        if ($params['countries']) {
            $movies->whereIn('country', $params['countries']);
        }
        if ($params['rating']) {
            $movies->whereIn('parental_rating', $params['rating']);
        }
        if ($params['runtime-min']) {
            $movies->where('runtime', '>=', $params['runtime-min']);
        }
        if ($params['runtime-max']) {
            $movies->where('runtime', '<=', $params['runtime-max']);
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
        return view('search.searchPage', compact('movies'));
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

        $nameTokens = explode(' ', $params['name']);

        $people = DB::table('people');
        $people->select('people.id', 
                        'people.first_name', 
                        'people.middle_name', 
                        'people.last_name',
                        'people.first_alias',
                        'people.middle_alias',
                        'people.last_alias',
                        'people.country_of_origin',
                        'people.date_of_birth',
                        'people.date_of_death',
                        'people.biography',
                        'people.album');
        $people->distinct('people.id');
        if ($nameTokens) {
            $people->join('person_suffixes', function($join) use ($nameTokens) {
                $join->on('people.id', '=', 'person_suffixes.person_id');
                array_map(function($name) use ($join) {
                    $join->orWhere('person_suffixes.name_suffix', 'LIKE', $name.'%');
                }, $nameTokens);
            });
        }
        if ($params['date-of-birth-start']) {
            $dob_start = date('Y-m-d', strtotime($params['date-of-birth-start']));
            $people->where('date_of_birth', '>=', $dob_start);
        }
        if ($params['date-of-birth-end']) {
            $dob_end = date('Y-m-d', strtotime($params['date-of-birth-end']));
            $people->where('date_of_birth', '<=', $dob_end);
        }
        if ($params['date-of-death-start']) {
            $dod_start = date('Y-m-d', strtotime($params['date-of-death-start']));
            $people->where('date_of_death', '>=', $dod_start);
        }
        if ($params['date-of-death-end']) {
            $dod_end = date('Y-m-d', strtotime($params['date-of-death-end']));
            $people->where('date_of_death', '<=', $dod_end);
        }
        if ($params['countries']) {
            $people->whereIn('country_of_origin', $params['countries']);
        }
        if ($params['keyword']) {
            $keywords = preg_replace("/[^A-Za-z0-9 ]/", '', $params['keyword']);

            $people->whereIn('people.id', function ($query) use ($keywords) {
                $query->select('id')
                    ->from('people')
                    ->whereRaw("MATCH(first_name, middle_name, last_name, first_alias, middle_alias, last_alias, biography) AGAINST('$keywords')");
            });
        }

        $people = $people->get();
        return view('search.searchPage', compact('people'));
    }

    public function get_suffixSearch_json($term)
    {
        // get search term and remove non-alpha-numeric characters
        $term = preg_replace("/[^A-Za-z0-9 ]/", '', $term);

        $people = $this->searchPeopleByTerm($term);
        $movies = $this->searchMoviesByTerm($term);

        return array_merge($movies, $people);
    }

    private function searchMoviesByTerm($term)
    {
        $results = DB::table('movies')
            ->select('movies.title AS title', 
                'movies.id AS id',
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

        $results = array_map(function($result) {
            return [
                'id'   => $result->id,
                'name' => $result->title,
                'year' => substr($result->date, 0, 4),
                'img'  => ($result->imgname) ? 
                                $result->imgpath . '/thumbs/' . $result->imgname . '.' . $result->imgext :
                                '/static/null_movie_125_175.png',
                'type' => 'm'
            ];
        }, $results);

        return $results;
    }

    private function searchPeopleByTerm($term)
    {
        $results = DB::table('people')
            ->select('people.id AS id',
                'people.first_name AS fn',
                'people.middle_name AS mn',
                'people.last_name AS ln',
                'people.first_alias AS fa',
                'people.middle_alias AS ma',
                'people.last_alias AS la',
                'people.date_of_birth AS dob',
                'people.date_of_death AS dod',
                'images.name AS imgname', 
                'images.path AS imgpath', 
                'images.extension AS imgext')
            ->distinct('people.id')
            ->join('albums', 'people.album', '=', 'albums.id')
            ->leftJoin('images', 'albums.default', '=', 'images.id')
            ->join('person_suffixes', function($join) use ($term) {
                $join->on('people.id', '=', 'person_suffixes.person_id')
                     ->where('person_suffixes.name_suffix', 'LIKE', $term.'%');
            })
            ->get();

        $results = array_map(function($result) {
            return [
                'id'   => $result->id,
                'name' => $this->bestName([$result->fn, $result->mn, $result->ln, $result->fa, $result->ma, $result->la]),
                'yob'  => substr($result->dob, 0, 4),
                'yod'  => substr($result->dod, 0, 4),
                'img'  => ($result->imgname) ? 
                                $result->imgpath . '/thumbs/' . $result->imgname . '.' . $result->imgext :
                                '/static/null_person_125_175.png',
                'type' => 'p',
            ];
        }, $results);

        return $results;
    }

    private function bestName($names) {
        $best = [];

        if ($names[3]) {
            array_push($best, $names[3]);
            if ($names[4]) array_push($best, $names[4]);
            if ($names[5]) array_push($best, $names[5]);
        }
        else {
            if ($names[0]) array_push($best, $names[0]);
            if ($names[2]) array_push($best, $names[2]);
        }

        if(empty($best))
            return '?';

        return implode(' ', $best);
    }
}









