<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Movie;
use Illuminate\Support\Facades\Input;
use Request;

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
        'title' => 'required',
        'country' => 'required',
        'release_date' => 'required',
        'genre' => 'required',
        'runtime' => 'required'
    ];

    /**
     * Person creation validation rules.
     *
     * @var array
     */
    protected $personValidationRules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'country_of_origin' => 'required',
        'date_of_birth' => 'required'
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
     * View all movies in the database
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showMovies() {
        $movies = Movie::latest()->get();
        return view('/admin/showAllMovies', compact('movies'));
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
     * Create and store movie in database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeMovie() {
        $validator = \Validator::make(Input::all(), $this->movieValidationRules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors());
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

        return redirect()->action('AdminController@showMovies');
    }

    /**
     * Taken to create person form view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createPerson() {
        return view('/admin/createPerson');
    }
}
