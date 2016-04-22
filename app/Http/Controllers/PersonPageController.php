<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Movie;
use App\Character;
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

        if($person) {
            $personAlbum = Album::find($person->album)->images;
            $dateOfBirth = date("F d, Y", strtotime($person->date_of_birth));
            $dateOfDeath = date("F d, Y", strtotime($person->date_of_death));
            $album = $person->album()->firstOrFail();
            $maxImages = 5;

            if (!$personAlbum)
            {
                $personAlbum = null;
            }

            $movieCollection = DB::table('movies')
                ->join('credits', 'id', '=', 'movie_id')
                ->join('albums', 'album', '=', 'albums.id')
                ->join('credit_types', 'credits.credit_type_id', '=', 'credit_types.id')
                ->leftJoin('images', 'albums.default', '=', 'images.id')
                ->join('characters', 'character_id', '=', 'characters.id')
                ->join('people', 'person_id', '=', 'people.id')
                ->where('person_id', '=', $person->id)
                ->get();


            if (count($movieCollection) === 1) {
                $firstMovieStarredIn = $movieCollection[0];
                $firstMovieRole = Character::find($firstMovieStarredIn->character_id);
                $newMovieCollection = null;
            } elseif (count($movieCollection) > 1) {
                $firstMovieStarredIn = $movieCollection[0];
                $firstMovieRole = Character::find($firstMovieStarredIn->character_id);
                $newMovieCollection = array_slice($movieCollection, 1);
            } else {
                $firstMovieStarredIn = null;
                $firstMovieRole = null;
                $newMovieCollection = null;
            }
        }

        return view('/people/person', compact(['person', 'personAlbum', 'dateOfBirth', 'dateOfDeath', 'album', 'maxImages', 'newMovieCollection', 'firstMovieStarredIn', 'firstMovieRole']));
    }
}