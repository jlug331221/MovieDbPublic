<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model {

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * A credit is associated with a particular movie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movie()
    {
        return $this->belongsTo('App\Movie');
    }

    /**
     * A credit is associated with a particular person.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    /**
     * A credit has a particular type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creditType()
    {
        return $this->belongsTo('App\CreditType');
    }

    /**
     * A credit may be associated with a particular character.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function character()
    {
        return $this->belongsTo('App\Character');
    }
}
