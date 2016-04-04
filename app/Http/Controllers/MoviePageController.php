<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Movie;
use App\Person;
use App\Credit;
use App\Character;

class MoviePageController extends Controller
{
    public function moviePage()
    {
        return view('movies.movie');
    }

    public function showMovie($id)
    {
        $castArray = [];
        $characterArray = [];

        $movie = Movie::find($id);
        $year = date("Y", strtotime($movie->release_date));
        $newDate = date("F d, Y", strtotime($movie->release_date));

        //credit_type_id needs to be static for the query? How are we structuring this?
        $creditDirector = Movie::find($id)->credits->where('credit_type_id', 1)->first();
        $directorID = $creditDirector->person_id;
        $director = Person::find($directorID);

        $peopleCollection = Movie::find($id)->credits;

        //First Person of cast table information
        $firstPerson = Person::find($peopleCollection->first()->person_id);
        $firstPersonCredit = Credit::where('person_id', $firstPerson->id)->first();
        $firstPersonRole = Character::find($firstPersonCredit->character_id);

        //Rest of people in cast table
        $newCollection = $peopleCollection->slice(1)->all();
        for ($i = 1; $i <= count($newCollection); $i++)
        {
            $castArray[$i] = Person::find($newCollection[$i]->person_id);
            $characterArray[$i] = Character::find($newCollection[$i]->character_id);
        }

        return view('/movies/movie', compact(['movie', 'year', 'newDate', 'director', 'firstPerson', 'firstPersonRole', 'castArray', 'characterArray']));
    }

}