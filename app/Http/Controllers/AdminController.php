<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use DB;

use App\Movie;
use App\Person;
use App\Character;
use App\CreditType;
use App\Album;
use App\Image;

use Illuminate\Support\Facades\Input;
use Request;
use Session;
use App\Library\StaticData;

class AdminController extends Controller
{
    private $countryNames;
    private $countryValues;
    private $countries;

    private $genreNames;
    private $genreValues;
    private $genres;

    private $ratingNames;
    private $ratingValues;
    private $ratings;


    /**
     * Create a new AdminController instance.
     *
     * AdminController constructor.
     */
    public function __construct() {
        $this->middleware('admin');

        $this->countryNames = StaticData::$countries;
        $this->countryValues = $this->countryNames;
        $this->countries = array_combine($this->countryNames, $this->countryValues);

        $this->genreNames = StaticData::$genres;
        $this->genreValues = $this->genreNames;
        $this->genres = array_combine($this->genreNames, $this->genreValues);

        $this->ratingNames = [
            'R'=> 'R', 'PG-13' => 'PG-13',
            'PG' => 'PG', 'G'=> 'G', 'NC-17' => 'NC-17'
        ];
        $this->ratingValues = $this->ratingNames;
        $this->ratings = array_combine($this->ratingNames, $this->ratingValues);
    }

    /**
     * Movie creation validation rules.
     *
     * @var array
     */
    protected $movieValidationRules = [
        'title' => 'required|string',
        'country' => 'required|string',
        'release_date' => 'required|date_format:m/d/Y',
        'genre' => 'required|string',
        'runtime' => 'required|integer'
    ];

    /**
     * Person creation validation rules.
     *
     * @var array
     */
    protected $personValidationRules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'country_of_origin' => 'required|string',
        'date_of_birth' => 'required|date_format:m/d/Y'
    ];

    /**
     * Go to the admin home page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $name = Auth::user()->name;
        return view('/admin/adminHome', compact('name'));
    }

    /**
     * View all movies in the database.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showMovies() {
        $movies = Movie::get();
        return view('/admin/showAllMovies', compact('movies'));
    }

    /**
     * Show specific movie for editing.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showMovie($id) {
        $countries = $this->countries;
        $genres = $this->genres;
        $ratings = $this->ratings;
        $movie = Movie::find($id);
        $selectedCountry = $movie->country;
        $selectedGenre = $movie->genre;
        $selectedRating = $movie->parental_rating;
        $convertedDate = date("m/d/Y", strtotime($movie->release_date));

        /*$credits = $movie->credits->all();
        $castInfo = []; $blueCollarCrew = []; $characters = []; $writers = [];
        $producers = []; $directors = [];
        for($i = 0; $i < count($credits); $i++) {
            $creditType = CreditType::find($credits[$i]->credit_type_id);
            $pId = $credits[$i]->person_id;
            $characterId = $credits[$i]->character_id;

            if($creditType->type === "Crew") {
                array_push($blueCollarCrew, Person::find($pId));
            }
            if($creditType->type === "Cast") {
                array_push($castInfo, Person::find($pId));
                array_push($characters, Character::find($characterId));
            }
            if($creditType->type === "Writer") {
                array_push($writers, Person::find($pId));
            }
            if($creditType->type === "Producer") {
                array_push($producers, Person::find($pId));
            }
            if($creditType->type === "Director") {
                array_push($directors, Person::find($pId));
            }
        }*/

        $movieAlbum = Album::find($movie->album)->images;

        //Get cast and crew information
        $cast = DB::table('movies')
                ->join('credits', 'id', '=', 'movie_id')
                ->join('people', 'person_id', '=', 'people.id')
                ->join('albums', 'people.album', '=', 'albums.id')
                ->join('credit_types', 'credits.credit_type_id', '=', 'credit_types.id')
                ->leftJoin('images', 'albums.default', '=', 'images.id')
                ->join('characters', 'character_id', '=', 'characters.id')
                ->where('movie_id', '=', $movie->id)
                ->where('type', '=', 'Cast')
                ->get();

        $crew = DB::table('movies')
                ->join('credits', 'id', '=', 'movie_id')
                ->join('people', 'person_id', '=', 'people.id')
                ->join('albums', 'people.album', '=', 'albums.id')
                ->join('credit_types', 'credits.credit_type_id', '=', 'credit_types.id')
                ->leftJoin('images', 'albums.default', '=', 'images.id')
                ->where('movie_id', '=', $movie->id)
                ->where('type', '!=', 'Cast')
                ->get();

        /*return view('/admin/showMovie', compact(['movie', 'selectedGenre',
            'countries', 'ratings', 'selectedRating', 'genres', 'convertedDate',
            'selectedCountry','castInfo', 'characters', 'directors', 'writers',
            'producers', 'movieAlbum', 'cast', 'crew']));*/

        return view('/admin/showMovie', compact(['movie', 'selectedGenre',
            'countries', 'ratings', 'selectedRating', 'genres', 'convertedDate',
            'selectedCountry', 'movieAlbum', 'cast', 'crew']));
    }

    /**
     * View all people in the database.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPeople() {
        $people = Person::get();
        return view('/admin/showAllPeople', compact('people'));
    }

    /**
     * Show specific person for editing.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPerson($id) {
        $countries = $this->countries;
        $person = Person::find($id);
        $selectedCountry = $person->country_of_origin;
        $convertedDateOfBirth = date("m/d/Y", strtotime($person->date_of_birth));
        $convertedDateOfDeath = date("m/d/Y", strtotime($person->date_of_death));

        $personAlbum = Album::find($person->album)->images;

        return view('/admin/showPerson', compact(['person', 'countries', 'selectedCountry',
                'convertedDateOfBirth', 'convertedDateOfDeath', 'personAlbum']));
    }

    /**
     * Taken to create movie form view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createMovie() {
        $countries = $this->countries;
        $genres = $this->genres;
        $ratings = $this->ratings;
        return view('/admin/createMovie', compact(['countries', 'genres', 'ratings']));
    }

    /**
     * Remove movie from database.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyMovie($id) {
        $movieSuffixes = DB::table('movie_suffixes')->where('movie_id', $id);
        if($movieSuffixes)
        {
            $movieSuffixes->delete();
        }
        $movie = Movie::find($id);
        $movie->delete();

        Session::flash('message', "Successfully deleted movie from database");
        return redirect()->action('AdminController@showMovies');

    }

    /**
     * Create and store movie in database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeMovie() {
        $validator = \Validator::make(Input::all(), $this->movieValidationRules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $movie = new Movie();
        $movie->title = Input::get('title');
        $movie->country = Input::get('country');
        $date = date("Y-m-d", strtotime(Input::get('release_date')));
        $movie->release_date = $date;
        $movie->genre = Input::get('genre');
        $movie->parental_rating = Input::get('parental_rating');
        $movie->runtime = Input::get('runtime');
        $movie->synopsis = Input::get('synopsis');
        $movie->save();

        return redirect()->action('AdminController@showMovies')->with('success',
            "Successfully added movie to database!");
    }

    /**
     * Update movie in database.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateMovie($id) {
        $validator = \Validator::make(Input::all(), $this->movieValidationRules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $movie = Movie::find($id);
        $movie->title = Input::get('title');
        $movie->country = Input::get('country');
        $date = date("Y-m-d", strtotime(Input::get('release_date')));
        $movie->release_date = $date;
        $movie->genre = Input::get('genre');
        $movie->parental_rating = Input::get('parental_rating');
        $movie->runtime = Input::get('runtime');
        $movie->synopsis = Input::get('synopsis');
        $movie->save();
        $movie->save();

        Session::flash('message', 'Successfully updated movie in database!');
        return redirect()->action('AdminController@showMovies');
    }

    /**
     * Taken to create person form view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createPerson() {
        $countries = $this->countries;
        return view('/admin/createPerson', compact(['countries']));
    }

    /**
     * Remove person from database.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyPerson($id) {
        $personSuffixes = DB::table('person_suffixes')->where('person_id', $id);
        if($personSuffixes)
        {
            $personSuffixes->delete();
        }

        $person = Person::find($id);
        $person->delete();

        Session::flash('message', "Successfully deleted person from database");
        return redirect()->action('AdminController@showPeople');
    }

    /**
     * Create and store person in database.
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function storePerson() {
        $validator = \Validator::make(Input::all(), $this->personValidationRules);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $person = new Person();
        $person->first_name = Input::get('first_name');
        $person->middle_name = Input::get('middle_name');
        $person->last_name = Input::get('last_name');
        $person->first_alias = Input::get('first_alias');
        $person->middle_alias = Input::get('middle_alias');
        $person->last_alias = Input::get('last_alias');
        $person->country_of_origin = Input::get('country_of_origin');
        $birthDate = date("Y-m-d", strtotime(Input::get('date_of_birth')));
        $deathDate = date("Y-m-d", strtotime(Input::get('date_of_death')));
        $person->date_of_birth = $birthDate;
        if($deathDate > "1970-01-01" || $deathDate < "1970-01-01") {
            $person->date_of_death = $deathDate;
        }
        $person->biography = Input::get('biography');
        $person->save();

        return redirect()->action('AdminController@showPeople')->with('success',
            "Successfully added person to database!");
    }

    /**
     * Update person in database.
     *
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function updatePerson($id) {
        $validator = \Validator::make(Input::all(), $this->personValidationRules);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $person = Person::find($id);
        $person->first_name = Input::get('first_name');
        $person->middle_name = Input::get('middle_name');
        $person->last_name = Input::get('last_name');
        $person->first_alias = Input::get('first_alias');
        $person->middle_alias = Input::get('middle_alias');
        $person->last_alias = Input::get('last_alias');
        $person->country_of_origin = Input::get('country_of_origin');
        $birthDate = date("Y-m-d", strtotime(Input::get('date_of_birth')));
        $deathDate = date("Y-m-d", strtotime(Input::get('date_of_death')));
        $person->date_of_birth = $birthDate;
        if($deathDate > "1970-01-01" || $deathDate < "1970-01-01") {
            $person->date_of_death = $deathDate;
        }
        $person->biography = Input::get('biography');
        $person->save();

        Session::flash('message', 'Successfully updated person in database!');
        return redirect()->action('AdminController@showPeople');
    }

    public function removeCastCrew($pid, $mid, $cTypeId) {
        $movie = Movie::find($mid);
        $person = Person::find($pid);
        $creditType = CreditType::find($cTypeId);
        DB::table('credits')->where('movie_id', $mid)
            ->where('person_id', $pid)
            ->where('credit_type_id', $cTypeId)
            ->delete();

        Session::flash('removeCastCrewMessage', "Successfully removed " . $person->first_name
            . ' ' . $person->last_name . " as " . $creditType->type . " from " . $movie->title);
        return redirect('admin/showMovie/' . $movie->id);
    }
}
