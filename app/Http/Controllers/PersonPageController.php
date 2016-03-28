<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Movie;

class PersonPageController extends Controller
{
    public function personPage()
    {
        return view('people.person');
    }
}