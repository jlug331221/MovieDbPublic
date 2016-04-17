<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Movie;
use App\Person;
use App\Credit;
use App\Character;
use App\Album;
use App\CreditType;

class MoviePageController extends Controller
{

    public function moviePage()
    {
        return view('movies.movie');
    }

    public function showMovie($id)
    {
        $movie = Movie::find($id);
        $director = Movie::find($id)->credits->where('credit_type_id', 1)->first();

        if ($movie) {
            $year = date("Y", strtotime($movie->release_date));
            $newDate = date("F d, Y", strtotime($movie->release_date));
            $movieAlbum = Album::find($movie->album)->images;
            $album = Movie::find($id)->album()->firstOrFail();
            $maxImages = 5;

            $creditDirector = Movie::find($id)->credits->where('credit_type_id', 1)->first();
            if ($creditDirector){
                $directorID = $creditDirector->person_id;
                $director = Person::find($directorID);
            }

            $castCollection = DB::table('movies')
                ->join('credits', 'id', '=', 'movie_id')
                ->join('people', 'person_id', '=', 'people.id')
                ->join('albums', 'people.album', '=', 'albums.id')
                ->join('credit_types', 'credits.credit_type_id', '=', 'credit_types.id')
                ->leftJoin('images', 'albums.default', '=', 'images.id')
                ->join('characters', 'character_id', '=', 'characters.id')
                ->where('movie_id', '=', $movie->id)
                ->where('type', '=', 'Cast')
                ->get();

            $crewCollection = DB::table('movies')
                ->join('credits', 'id', '=', 'movie_id')
                ->join('people', 'person_id', '=', 'people.id')
                ->join('albums', 'people.album', '=', 'albums.id')
                ->join('credit_types', 'credits.credit_type_id', '=', 'credit_types.id')
                ->leftJoin('images', 'albums.default', '=', 'images.id')
                ->where('movie_id', '=', $movie->id)
                ->where('type', '!=', 'Cast')
                ->get();


            if (count($castCollection) > 1 && count($crewCollection) > 1) {
                $newCastCollection = array_slice($castCollection, 1);
                $newCrewCollection = array_slice($crewCollection, 1);
                $firstPersonCast = $castCollection[0];
                $firstPersonRole = Character::find($firstPersonCast->character_id);
                $firstPersonCrew = $crewCollection[0];
            }
            elseif (count($castCollection) === 1 && count($crewCollection) === 1)
            {
                $firstPersonCast = $castCollection[0];
                $firstPersonRole = Character::find($firstPersonCast->character_id);
                $firstPersonCrew = $crewCollection[0];
                $newCastCollection = null;
                $newCrewCollection = null;
            }
            elseif (count($castCollection) === 1 && count($crewCollection) > 1) {

                $newCrewCollection = array_slice($crewCollection, 1);
                $firstPersonCast = $castCollection[0];
                $firstPersonRole = Character::find($firstPersonCast->character_id);
                $firstPersonCrew = $crewCollection[0];
                $newCastCollection = null;
            }
            elseif (count($castCollection) > 1 && count($crewCollection) === 1) {

                $newCastCollection = array_slice($castCollection, 1);
                $firstPersonCast = $castCollection[0];
                $firstPersonRole = Character::find($firstPersonCast->character_id);
                $firstPersonCrew = $crewCollection[0];
                $newCrewCollection = null;
            }
            else {
                $newCastCollection = null;
                $firstPersonCast = null;
                $firstPersonRole = null;
                $firstPersonCrew = null;
                $newCrewCollection = null;
            }
        }

        return view('/movies/movie', compact(['movie', 'year', 'newDate', 'director', 'firstPersonCast', 'firstPersonRole', 'newCastCollection',
                    'firstPersonCrew', 'newCrewCollection', 'album', 'maxImages', 'movieAlbum']));
    }
}