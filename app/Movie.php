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
            $model->populateSuffixes($model);
        }, 0);

        /**
         * Updates all alpha-numeric suffixes (per word) of a the movie's
         * title in the movie_suffixes table.
         */
        static::updated(function ($model) {
            $model->discardSuffixes($model);
            $model->populateSuffixes($model);
        }, 0);

        /**
         * Removes any suffixes associated with the movie before deletion.
         */
        static::deleting(function ($model) {
            $model->discardSuffixes($model);
        }, 0);
    }

    /**
     * Populates all alpha-numeric suffixes of the models title
     * and stores them in the movie_suffixes table, linking each
     * to the movie's id.
     *
     * @param Movie $model
     */
    private function populateSuffixes($model)
    {
        $suffix = preg_replace("/[^A-Za-z0-9 ]/", '', $model->title);
        $delim = 0;
        while (true) {
            $suffix = substr($suffix, $delim);
            DB::table('movie_suffixes')->insert(['movie_id' => $model->id, 'title_suffix' => $suffix]);
            $delim = strpos($suffix, ' ');
            if ( ! $delim) break;
            $delim++;
        }
    }

    /**
     * Removes any suffixes in the movie_suffixes table associated
     * with the movie's id.
     *
     * @param Movie $model
     */
    private function discardSuffixes($model)
    {
        $id = $model->id;
        DB::table('movie_suffixes')
            ->where('movie_id', '=', $id)
            ->delete();
    }
}












