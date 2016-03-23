<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Movie;
use App\Person;
use Illuminate\Support\Facades\Input;
use Request;
use Session;

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

        $this->countryNames = [
            "United States",
            "Afghanistan",
            "Albania",
            "Algeria",
            "American Samoa",
            "Andorra",
            "Angola",
            "Anguilla",
            "Antarctica",
            "Antigua and Barbuda",
            "Argentina",
            "Armenia",
            "Aruba",
            "Australia",
            "Austria",
            "Azerbaijan",
            "Bahamas",
            "Bahrain",
            "Bangladesh",
            "Barbados",
            "Belarus",
            "Belgium",
            "Belize",
            "Benin",
            "Bermuda",
            "Bhutan",
            "Bolivia",
            "Bosnia and Herzegovina",
            "Botswana",
            "Bouvet Island",
            "Brazil",
            "British Antarctic Territory",
            "British Indian Ocean Territory",
            "British Virgin Islands",
            "Brunei",
            "Bulgaria",
            "Burkina Faso",
            "Burundi",
            "Cambodia",
            "Cameroon",
            "Canada",
            "Canton and Enderbury Islands",
            "Cape Verde",
            "Cayman Islands",
            "Central African Republic",
            "Chad",
            "Chile",
            "China",
            "Christmas Island",
            "Cocos [Keeling] Islands",
            "Colombia",
            "Comoros",
            "Congo - Brazzaville",
            "Congo - Kinshasa",
            "Cook Islands",
            "Costa Rica",
            "Croatia",
            "Cuba",
            "Cyprus",
            "Czech Republic",
            "Côte d’Ivoire",
            "Denmark",
            "Djibouti",
            "Dominica",
            "Dominican Republic",
            "Dronning Maud Land",
            "East Germany",
            "Ecuador",
            "Egypt",
            "El Salvador",
            "Equatorial Guinea",
            "Eritrea",
            "Estonia",
            "Ethiopia",
            "Falkland Islands",
            "Faroe Islands",
            "Fiji",
            "Finland",
            "France",
            "French Guiana",
            "French Polynesia",
            "French Southern Territories",
            "French Southern and Antarctic Territories",
            "Gabon",
            "Gambia",
            "Georgia",
            "Germany",
            "Ghana",
            "Gibraltar",
            "Greece",
            "Greenland",
            "Grenada",
            "Guadeloupe",
            "Guam",
            "Guatemala",
            "Guernsey",
            "Guinea",
            "Guinea-Bissau",
            "Guyana",
            "Haiti",
            "Heard Island and McDonald Islands",
            "Honduras",
            "Hong Kong SAR China",
            "Hungary",
            "Iceland",
            "India",
            "Indonesia",
            "Iran",
            "Iraq",
            "Ireland",
            "Isle of Man",
            "Israel",
            "Italy",
            "Jamaica",
            "Japan",
            "Jersey",
            "Johnston Island",
            "Jordan",
            "Kazakhstan",
            "Kenya",
            "Kiribati",
            "Kuwait",
            "Kyrgyzstan",
            "Laos",
            "Latvia",
            "Lebanon",
            "Lesotho",
            "Liberia",
            "Libya",
            "Liechtenstein",
            "Lithuania",
            "Luxembourg",
            "Macau SAR China",
            "Macedonia",
            "Madagascar",
            "Malawi",
            "Malaysia",
            "Maldives",
            "Mali",
            "Malta",
            "Marshall Islands",
            "Martinique",
            "Mauritania",
            "Mauritius",
            "Mayotte",
            "Metropolitan France",
            "Mexico",
            "Micronesia",
            "Midway Islands",
            "Moldova",
            "Monaco",
            "Mongolia",
            "Montenegro",
            "Montserrat",
            "Morocco",
            "Mozambique",
            "Myanmar [Burma]",
            "Namibia",
            "Nauru",
            "Nepal",
            "Netherlands",
            "Netherlands Antilles",
            "Neutral Zone",
            "New Caledonia",
            "New Zealand",
            "Nicaragua",
            "Niger",
            "Nigeria",
            "Niue",
            "Norfolk Island",
            "North Korea",
            "North Vietnam",
            "Northern Mariana Islands",
            "Norway",
            "Oman",
            "Pacific Islands Trust Territory",
            "Pakistan",
            "Palau",
            "Palestinian Territories",
            "Panama",
            "Panama Canal Zone",
            "Papua New Guinea",
            "Paraguay",
            "People's Democratic Republic of Yemen",
            "Peru",
            "Philippines",
            "Pitcairn Islands",
            "Poland",
            "Portugal",
            "Puerto Rico",
            "Qatar",
            "Romania",
            "Russia",
            "Rwanda",
            "Réunion",
            "Saint Barthélemy",
            "Saint Helena",
            "Saint Kitts and Nevis",
            "Saint Lucia",
            "Saint Martin",
            "Saint Pierre and Miquelon",
            "Saint Vincent and the Grenadines",
            "Samoa",
            "San Marino",
            "Saudi Arabia",
            "Senegal",
            "Serbia",
            "Serbia and Montenegro",
            "Seychelles",
            "Sierra Leone",
            "Singapore",
            "Slovakia",
            "Slovenia",
            "Solomon Islands",
            "Somalia",
            "South Africa",
            "South Georgia and the South Sandwich Islands",
            "South Korea",
            "Spain",
            "Sri Lanka",
            "Sudan",
            "Suriname",
            "Svalbard and Jan Mayen",
            "Swaziland",
            "Sweden",
            "Switzerland",
            "Syria",
            "São Tomé and Príncipe",
            "Taiwan",
            "Tajikistan",
            "Tanzania",
            "Thailand",
            "Timor-Leste",
            "Togo",
            "Tokelau",
            "Tonga",
            "Trinidad and Tobago",
            "Tunisia",
            "Turkey",
            "Turkmenistan",
            "Turks and Caicos Islands",
            "Tuvalu",
            "U.S. Minor Outlying Islands",
            "U.S. Miscellaneous Pacific Islands",
            "U.S. Virgin Islands",
            "Uganda",
            "Ukraine",
            "Union of Soviet Socialist Republics",
            "United Arab Emirates",
            "United Kingdom",
            "Uruguay",
            "Uzbekistan",
            "Vanuatu",
            "Vatican City",
            "Venezuela",
            "Vietnam",
            "Wake Island",
            "Wallis and Futuna",
            "Western Sahara",
            "Yemen",
            "Zambia",
            "Zimbabwe",
            "Åland Islands"
        ];
        $this->countryValues = $this->countryNames;
        $this->countries = array_combine($this->countryNames, $this->countryValues);

        $this->genreNames = [
            'Action',
            'Adventure',
            'Animation',
            'Biography',
            'Comedy',
            'Crime',
            'Documentary',
            'Drama',
            'Family',
            'Fantasy',
            'Film-Noir',
            'History',
            'Horror',
            'Music',
            'Musical',
            'Mystery',
            'Romance',
            'Sci-Fi',
            'Sport',
            'Thriller',
            'War',
            'Western'
        ];
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
        return view('/admin/showMovie', compact(['movie', 'selectedGenre',
            'countries', 'ratings', 'selectedRating', 'genres',
            'convertedDate', 'selectedCountry']));
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
        return view('/admin/showPerson', compact(['person', 'countries', 'selectedCountry',
                'convertedDateOfBirth', 'convertedDateOfDeath']));
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

        Session::flash('message', 'Successfully added movie to database!');
        return redirect()->action('AdminController@showMovies');
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

        Session::flash('message', 'Successfully added person to database!');
        return redirect()->action('AdminController@showPeople');
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
}
