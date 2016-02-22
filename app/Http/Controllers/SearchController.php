<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function advancedMovie()
    {
        return view('search.advmovie');
    }

    public function advancedPerson()
    {
        return view('search.advperson');
    }
}
