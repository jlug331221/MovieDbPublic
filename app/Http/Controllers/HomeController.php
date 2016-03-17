<?php

namespace App\Http\Controllers;

use App\Masterlist;
use App\MovieList;
use App\PersonList;
use App\Image;
use App\Movie;
use Auth;
use App\Http\Requests;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Session;

use DB;
use App\Http\Requests\CreateImageRequest;
use Faker\Factory;
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

        return view('/userpage/home', compact('name','masterlists','avatar'));
    }

    public function avatar()
    {
        $avatar_id = Auth::user()->avatar;
        $av_image = Image::where('id', '=' ,$avatar_id)->first();
        $avatar = $av_image['path'].'/'.$av_image['name'].'.'.$av_image['extension'];
        return view('/userpage/avatar', compact('avatar'));
    }

    public function store(CreateImageRequest $request)
    {
        $file = $request->file('image');
        $description = $request->get('description');

        try {
            $image = ImageSync::create($file, $description);
            Auth::user()->setAvatar($image);
            Session::flash('message', 'Successfully changed avatar!');
        } catch (\Exception $e) {
            dd($e->getMessage());
            // do something here like log the error.
        }
        return redirect('/userpage/home');
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
}
