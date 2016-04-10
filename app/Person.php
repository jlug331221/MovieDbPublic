<?php

namespace App;

use Illuminate\Support\Facades\DB;
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
     * Approximates the best name for the person. If the
     * person has a first alias, the alias is used. Else the
     * first and last names are attempted. If no suitable name
     * exists, then the string '?' is returned.
     *
     * @return String
     */
    public function getBestName()
    {
        $best = [];

        if ($this->first_alias) {
            if ($this->first_alias) array_push($best, $this->first_alias);
            if ($this->middle_alias) array_push($best, $this->middle_alias);
            if ($this->last_alias) array_push($best, $this->last_alias);
        } else {
            if ($this->first_name) array_push($best, $this->first_name);
            if ($this->last_name) array_push($best, $this->last_name);
        }

        if (empty($best))
            return '?';

        return implode(' ', $best);
    }

    /**
     * Returns the birth year of the person, followed by the
     * death year, if it exists, separated by a dash.
     * Example: '1954 - 2004'
     * If a birth year does not exist, '?' is returned.
     *
     * @return String
     */
    public function getBirthAndDeathYears()
    {
        if ($this->date_of_birth)
            $years = substr($this->date_of_birth, 0, 4);
        else
            return '?';
        if ($this->date_of_death)
            $years .= ' - ' . substr($this->date_of_death, 0, 4);

        return $years;
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

        /**
         * Generates all alpha-numeric suffixes (per character) of the person's name
         * fields into the person_suffixes table.
         */
        static::created(function ($model) {
            $model->populateSuffixes($model);
        }, 0);

        /**
         * Updates all alpha-numeric suffixes (per character) of a the person's
         * name in the person_suffixes table.
         */
        static::updated(function ($model) {
            $model->discardSuffixes($model);
            $model->populateSuffixes($model);
        }, 0);

        /**
         * Removes any suffixes associated with the person before deletion.
         */
        static::deleting(function ($model) {
            $model->discardSuffixes($model);
        }, 0);
    }

    /**
     * Populates all alpha-numeric suffixes for the Person's names and
     * stores them the person_suffies table, linking each to the person's id.
     * @param $model App\Person Person being updated.
     */
    private function populateSuffixes($model)
    {
        $names = [
            $model->first_name,
            $model->middle_name,
            $model->last_name,
            $model->first_alias,
            $model->middle_alias,
            $model->last_alias,
        ];

        array_map(function ($name) use ($model) {
            $len = strlen($name);
            for ($i = 0; $i < $len; $i++)
                DB::table('person_suffixes')
                    ->insert(['person_id'   => $model->id,
                              'name_suffix' => substr($name, $i)]);
        }, $names);
    }

    /**
     * Removes any suffixes in the person_suffixes table associated
     * with the model's id.
     * @param $model App\Person
     */
    private function discardSuffixes($model)
    {
        $id = $model->id;
        DB::table('person_suffixes')
            ->where('person_id', '=', $id)
            ->delete();
    }
}
