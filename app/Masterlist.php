<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masterlist extends Model
{
    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'masterlist_id', 'user_id', 'title', 'type'
    ];

    /**
     * A review belongs to a single user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function movielist()
    {
        return $this->hasMany('App\MovieList');
    }

    public function personlist()
    {
        return $this->hasMany('App\PersonList');
    }
}
