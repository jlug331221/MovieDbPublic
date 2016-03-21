<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model {

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'first_alias',
        'middle_alias',
        'last_alias',
        'country_of_origin',
        'date_of_birth',
        'date_of_death',
        'biography'
    ];

    /**
     * A person may have zero or more credits in a Movie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function credits()
    {
        return $this->hasMany('App\Credit');
    }

    /**
     * A person is associated with an album.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function album()
    {
        return $this->hasOne('App\Album', 'id', 'album');
    }

    /**
     * A person is associated with many PersonLists.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function personlists()
    {
        return $this->belongsToMany('App\PersonList');
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
         * Generates an album for the person before creation.
         */
        static::creating(function ($model) {
            $album = new Album();
            $album->save();
            $model->album = $album->id;
        }, 0);
    }
}
