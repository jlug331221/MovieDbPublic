<?php

namespace App\Http\Controllers;

use App\Masterlist;
use App\MovieList;
use App\PersonList;
use App\Movie;
use App\Person;
use App\Image;
use App\User;
use Auth;
use App\Http\Requests;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Session;
use App\Library\StaticData;
use DB;
use App\Http\Requests\CreateImageRequest;

use Image as InterventionImage;
use ImageSync;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected $CreateListValidationRules = [
        'title' => 'required',
        'type' => 'required'
    ];

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = Auth::user()->name;
        $masterlists = Masterlist::where('user_id', Auth::user()->id)->get();
        $avatar_id = Auth::user()->avatar;
        $av_image = Image::where('id', '=' ,$avatar_id)->first();
        $avatar = $av_image['path'].'/'.$av_image['name'].'.'.$av_image['extension'];
        if($avatar == '/.'){
            $avatar = StaticData::defaultAvatar();
        }
        return view('/userpage/home', compact('name','masterlists','avatar'));
    }

    public function avatar()
    {
        $avatar_id = Auth::user()->avatar;
        $av_image = Image::where('id', '=' ,$avatar_id)->first();
        $avatar = $av_image['path'].'/'.$av_image['name'].'.'.$av_image['extension'];
        if($avatar == '/.'){
            $avatar = StaticData::defaultAvatar();
        }
        return view('/userpage/avatar', compact('avatar'));
    }

    public function store(CreateImageRequest $request)
    {
        $file = $request->file('image');
        $description = $request->get('description');

        try {
            $image = ImageSync::create($file, $description);
            $this->discard();
            Auth::user()->setAvatar($image);
            Session::flash('message', 'Successfully changed avatar!');
        } catch (\Exception $e) {
            dd($e->getMessage());
            // do something here like log the error.
        }
        return redirect('/userpage/home');
    }

    public function discard()
    {
        $image = Auth::user()->avatar;
        if ($image != null)
            ImageSync::destroy($image);
    }

    public function getMoviesInList($masterlist_id)
    {
        $movielist = MovieList::where('id', $masterlist_id)->first();
        $movielistid = $movielist['id'];
        return $movielistid;

    }

    public function deleteList($mlid)
    {
        $ml = Masterlist::where('id', '=', $mlid)->first();
        if ($ml != null) {
            Masterlist::destroy($mlid);
        } else {
            return redirect()->action('HomeController@index');
        }
        return redirect()->action('HomeController@index');
    }

    public function postList()
    {
        $validator = \Validator::make(Input::all(), $this->CreateListValidationRules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $input = Request::all();
        $masterlist = new Masterlist();
        $masterlist->user_id = Auth::user()->id;
        $masterlist->title = $input['title'];
        $masterlist->type = $input['type'];
        $masterlist->save();

        $mlid = $masterlist->id;
        if($input['type'] == 'M')
        {
            $movielist = new MovieList();
            $movielist->masterlist_id = $mlid;
            $movielist->save();
        }
        else //type is P
        {
            $personlist = new PersonList();
            $personlist->masterlist_id = $mlid;
            $personlist->save();
        }
        Session::flash('message', 'Successfully created list!');
        return redirect()->action('HomeController@index');
    }

    public function postAddMovieToList($id, $lid)
    {
        try {
            $movieid = $id;
            $movielistid = $lid;
            $movielist = MovieList::where('id', '=', $movielistid)->first();
            $movie = Movie::where('id', '=', $movieid)->first();
            $movielist->insertMovieInto($movie);
            Session::flash('message', 'Successfully added ' . $movie->title .' to your list!');
            return redirect()->action('HomeController@index');
        }
        catch (QueryException $e) {
            Session::flash('alert', 'Error, '.$movie->title.' already exists in this list!');
            return redirect()->action('HomeController@index');
        }
    }

    public function postAddPersonToList($id, $lid)
    {
        try {
            $peopleid = $id;
            $personlistid = $lid;
            $personlist = PersonList::where('id', '=', $personlistid)->first();
            $person = Person::where('id', '=', $peopleid)->first();
            $personlist->insertPersonInto($person);
            Session::flash('message', 'Successfully added ' . $person->getBestName() .' to your list!');
            return redirect()->action('HomeController@index');
        }
        catch (QueryException $e) {
            Session::flash('alert', 'Error, '.$person->getBestName().' already exists in this list!');
            return redirect()->action('HomeController@index');
        }
    }

    public function deleteMovieItem($mid, $mlid)
    {
        $movieid = $mid;
        $movielistid = $mlid;
        DB::table('movie_movie_list')
            ->where('movie_id', $mid)
            ->where('movie_list_id', $mlid)
            ->delete();
        Session::flash('message', 'Successfully deleted movie from your list!');
        return redirect()->action('HomeController@index');
    }

    public function deletePersonItem($pid, $plid)
    {
        $personid = $pid;
        $personlistid = $plid;
        DB::table('person_person_list')
            ->where('person_id', $pid)
            ->where('person_list_id', $plid)
            ->delete();
        Session::flash('message', 'Successfully deleted person from your list!');
        return redirect()->action('HomeController@index');
    }

    public function get_suffixPersonSearch_json($term)
    {
        // get search term and remove non-alpha-numeric characters
        $term = preg_replace("/[^A-Za-z0-9 ]/", '', $term);

        $people = $this->searchPeopleByTerm($term);

        return array_merge($people);
    }

    public function get_suffixMovieSearch_json($term)
    {
        // get search term and remove non-alpha-numeric characters
        $term = preg_replace("/[^A-Za-z0-9 ]/", '', $term);

        $movies = $this->searchMoviesByTerm($term);

        return array_merge($movies);
    }

    /**
     * Searches for movies based on title suffixes using the given term.
     *
     * @param string $term Search term
     * @return array
     */
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
                    ->where('movie_suffixes.title_suffix', 'LIKE', $term . '%');
            })
            ->get();

        $results = array_map(function ($result) {
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

    /**
     * Searches for people based on name suffixes using the given term.
     *
     * @param string $term Search term
     * @return array
     */
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
            ->join('person_suffixes', function ($join) use ($term) {
                $join->on('people.id', '=', 'person_suffixes.person_id')
                    ->where('person_suffixes.name_suffix', 'LIKE', $term . '%');
            })
            ->get();

        $results = array_map(function ($result) {
            return [
                'id'   => $result->id,
                'name' => StaticData::findBestName([$result->fn, $result->mn, $result->ln, $result->fa, $result->ma, $result->la]),
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

}
