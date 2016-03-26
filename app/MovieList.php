<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieList extends Model
{
    //
    protected $fillable = [
        'masterlist_id'
    ];

    public function masterlist()
    {
        return $this->belongsTo('App\Masterlist');
    }

    public function movies()
    {
        return $this->belongsToMany('App\Movie');
    }

/* Insert a movie to a movielist.
*
* @param Movie $movie
*
* @return Model
*/
    public function insertMovieInto(Movie $movie) {
        return $this->movies()->save($movie);
    }
}
