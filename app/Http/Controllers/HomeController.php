<?php

namespace App\Http\Controllers;

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
        return view('/userpage/home', compact('name'));
    }

    public function createList()
    {
        return view('/userpage/createList');
    }

    public function storeList()
    {
        $input = Request::all();
        if($input['type'] == 'Movie')
        {
            return 'movie list';
        }

        return $input;
    }
}
