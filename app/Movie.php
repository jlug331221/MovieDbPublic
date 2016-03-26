<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Album;

class Movie extends Model {

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'country',
        'release_date',
        'genre',
        'parental_rating',
        'runtime',
        'synopsis'
    ];

    /**
     * A movie contains zero or more credits.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function credits()
    {
        return $this->hasMany('App\Credit');
    }

    /**
     * A movie is associated with multiple reviews.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    /**
     * A movie is associated with many MovieLists.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function movielists()
    {
        return $this->belongsToMany('App\MovieList');
    }

    /**
     * A movie is associated with an album.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function album()
    {
        return $this->hasOne('App\Album', 'id', 'album');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        /**
         * Generates an album for the movie before creation.
         */
        static::creating(function ($model) {
            $album = new Album();
            $album->save();
            $model->album = $album->id;
        }, 0);

        /**
         * Generates all alpha-numeric suffixes (per word) of the movie's title
         * into the movie_suffixes table.
         */
        static::created(function ($model) {
            $suffix = preg_replace("/[^A-Za-z0-9 ]/", '', $model->title);
            $delim = 0;
            while (true) {
                $suffix = substr($suffix, $delim);
                DB::table('movie_suffixes')->insert(['movie_id' => $model->id, 'title_suffix' => $suffix]);
                $delim = strpos($suffix, ' ');
                if ( ! $delim) break;
                $delim++;
            }
        }, 0);
    }
}












