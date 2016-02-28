<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {

    const IMAGE_DIRECTORY = '/images';
    const IMAGES_PER_SUBDIRECTORY = 1000;

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path',
        'extension',
        'description'
    ];

    /**
     * An image can be attached to a single user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'avatar');
    }

    /**
     * An image can be attached to many albums.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function albums()
    {
        return $this->belongsToMany('App\Album');
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
         * Generates a unique token for the image
         */
        static::creating(function ($model) {
            // 238328 = 1000 base 62
            // 14776335 = zzzz base 62
            $model->token = gmp_strval(mt_rand(238328, 14775335), 62);
        }, 0);
    }

    /**
     * Returns the unique name of the image.
     *
     * @return string
     */
    public function getName()
    {
        return $this->id . $this->token . '.' . $this->extension;
    }

    /**
     * Returns the path of the image.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path . '/' . $this->getName();
    }

    /**
     * Returns the absolute path of the image.
     *
     * @return string
     */
    public function getAbsolutePath()
    {
        return public_path() . $this->getPath();
    }

    /**
     * Attempts to find the instance of the image with the given unique name.
     *
     * @param string $name
     * @return mixed
     */
    public static function lookup($name)
    {
        $id = substr($name, 0, strlen($name) - 4);
        return Image::find($id);
    }

    /**
     * Derives the path for an image based on its id. The path will be
     * IMAGE_DIRECTORY/subdirectory, where subdirectory is generated from
     * the image's id. Each subdirectory holds a maximum of
     * IMAGES_PER_SUBDIRECTORY number of images, where the auto-incremented
     * id of the image is used to partition the subdirectories.
     *
     * @return string
     */
    public function derivePathFromId()
    {
        $subDirectory = substr(md5(intval($this->id / self::IMAGES_PER_SUBDIRECTORY)), 0, 8);
        return self::IMAGE_DIRECTORY . '/' . $subDirectory;
    }
}
