<?php

//Created by Ashley

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Movie;
use App\Masterlist;
use App\Person;
use App\Credit;
use App\Discussion;
use App\Character;
use App\Album;
use App\CreditType;
use App\Review;
use Auth;
//Used for review avatars
use App\Image;
use Image as InterventionImage;
use ImageSync;
use App\Library\StaticData;

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

        $discussions = Discussion::orderBy('created_at', 'dsc')->get()->slice(0, 3);

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


            if(count($castCollection) > 1) {
                $newCastCollection = array_slice($castCollection, 1);
                $firstPersonCast = $castCollection[0];
                $firstPersonRole = Character::find($firstPersonCast->character_id);
            }
            elseif(count($castCollection) === 1) {
                $newCastCollection = null;
                $firstPersonCast = $castCollection[0];
                $firstPersonRole = Character::find($firstPersonCast->character_id);
            }
            else {
                $newCastCollection = null;
                $firstPersonCast = null;
                $firstPersonRole = null;
            }

            if(count($crewCollection) > 1) {
                $newCrewCollection = array_slice($crewCollection, 1);
                $firstPersonCrew = $crewCollection[0];
            }
            elseif(count($crewCollection) === 1) {
                $newCrewCollection = null;
                $firstPersonCrew = $crewCollection[0];
            }
            else {
                $newCrewCollection = null;
                $firstPersonCrew = null;
            }

            //Get 3 reviews for movie
            $reviews = Review::where('movie_id', $id)->orderBy('score', 'dsc')->get()->slice(0, 3);

            //Get avatars for reviews
            foreach($reviews as $review)
            {
                $reviewAvatarId = $review->user()->firstOrFail()->avatar;
                $reviewAvImage = Image::where('id', '=', $reviewAvatarId)->first();
                $reviewAvatar = $reviewAvImage['path'].'/'.$reviewAvImage['name'].'.'.$reviewAvImage['extension'];
                if($reviewAvatar == '/.'){
                    $reviewAvatar = StaticData::defaultAvatar();
                }
                $review->avatar = $reviewAvatar;
            }

            //Get movielists for user
            $masterlists = Masterlist::where('user_id', Auth::user()->id)->get();


        }

        return view('/movies/movie', compact(['movie', 'year', 'newDate', 'director', 'firstPersonCast', 'firstPersonRole', 'newCastCollection',
<<<<<<< HEAD
                    'firstPersonCrew', 'newCrewCollection', 'album', 'maxImages', 'movieAlbum']))->with([
            'discussions' => $discussions
        ]);
=======
                    'firstPersonCrew', 'newCrewCollection', 'album', 'maxImages', 'movieAlbum', 'reviews', 'masterlists']));
>>>>>>> 475d8a6c63e80155d412ce4851964239525e682c
    }
}