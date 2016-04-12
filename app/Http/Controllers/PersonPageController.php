<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Movie;
use App\Person;
use App\Album;
use App\Library\StaticData;

class PersonPageController extends Controller
{
    public function personPage()
    {
        return view('people.person');
    }

    public function showPerson($id)
    {
        $person = Person::find($id);
        $personAlbum = Album::find($person->album)->images;
        $dateOfBirth = date("F d, Y", strtotime($person->date_of_birth));
        $dateOfDeath = date("F d, Y", strtotime($person->date_of_death));



        return view('/people/person', compact(['person', 'personAlbum', 'dateOfBirth', 'dateOfDeath']));
    }
}