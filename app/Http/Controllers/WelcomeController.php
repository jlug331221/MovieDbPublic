<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class WelcomeController extends Controller
{
    //Display home page
    public function display()
    {
        return view('welcome');
    }
}
