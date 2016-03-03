<?php

namespace App\Http\Controllers;

use App\Masterlist;
use App\MovieList;
use App\PersonList;
use App\Movie;
use Auth;
use App\Http\Requests;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = Auth::user()->name;
        $masterlists = Masterlist::where('user_id', Auth::user()->id)->get();
        return view('/userpage/home', compact('name','masterlists'));
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

    public function storeList()
    {
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

        return redirect()->action('HomeController@index');
    }
}
