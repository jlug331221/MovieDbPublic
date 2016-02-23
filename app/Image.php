<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Image extends Model {

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'path',
        'extension'
    ];

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool false
     */
    public function getIncrementing()
    {
        return false;
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
         * Generates a Uuid as the id for the model before
         * the model is created.
         */
        static::creating(function ($model) {
            $model->id = Uuid::generate(4)->bytes;
        }, 0);
    }

    /**
     * Gets the id of an image as a hex string.
     *
     * @param $value
     * @return string
     */
    public function getIdAttribute($value)
    {
        return bin2hex($value);
    }

    /**
     * Find a model by its primary key using a hex string.
     *
     * @param  mixed  $id
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|null
     */
    public static function find($id, $columns = ['*'])
    {
        return static::where('id', '=', hex2bin($id))->first($columns);
    }

    /**
     * An image can be attached to a single user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user() {
        return $this->belongsTo('App\User', 'avatar');
    }

    /**
     * An image can be attached to many albums.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function albums() {
        return $this->belongsToMany('App\Album');
    }
}
