<?php

namespace App;

use App\Library\StaticData;
use Illuminate\Database\Eloquent\Model;

class Image extends Model {

    /**
     * Valid file extensions for images.
     *
     * @var array
     */
    const VALID_EXTENSIONS = [
        'png',
        'jpeg',
        'jpg',
        'bmp'
    ];

    /**
     * Root image directory for the project.
     */
    const IMAGE_DIRECTORY = '/images';

    /**
     * Maximum number of images that a subdirectory may hold.
     */
    const IMAGES_PER_SUBDIRECTORY = 1000;

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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
         * Generates a unique name for the image before creation.
         */
        static::creating(function ($model) {

            $name = '';

            do {
                $chars = array_merge(range('0', '9'), range('A', 'Z'), range('a', 'z'));
                foreach(range(0, 6) as $n) {
                    $name .= $chars[rand(0, 61)];
                }
            } while (Image::where('name', '=', '$name')->first() != null);

            $model->name = $name;

        }, 0);

        /**
         * Generates the path for an image directly after creation.
         *
         * The path will be IMAGE_DIRECTORY/subdirectory, where subdirectory
         * is generated from the image's id.
         *
         * Each subdirectory holds a maximum of IMAGES_PER_SUBDIRECTORY number
         * of images, where the auto-incremented id of the image is used to
         * partition the subdirectories.
         */
        static::created(function ($model) {

            $subDirectory = substr(md5(intval($model->id / self::IMAGES_PER_SUBDIRECTORY)), 0, 8);

            $model->path = self::IMAGE_DIRECTORY . '/' . $subDirectory;
            $model->save();

        }, 0);
    }

    /**
     * Returns the unique name of the image file.
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->name . '.' . $this->extension;
    }

    /**
     * Returns the path of the image from the public directory.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path . '/' . $this->getFileName();
    }

    /**
     * Returns the path of the thumbnail from the public directory
     *
     * @return string
     */
    public function getThumbPath()
    {
        return $this->path . '/thumbs/' . $this->getFileName();
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
     * Returns the absolute path of the image thumbnail.
     *
     * @return string
     */
    public function getAbsoluteThumbPath()
    {
        return public_path() . $this->getThumbPath();
    }

    /**
     * Returns whether the given extension is a valid image extension.
     *
     * @param $extension
     * @return bool
     */
    public static function isValidExtension($extension)
    {
        return in_array($extension, self::VALID_EXTENSIONS);
    }

    /**
     * Returns an array containing the valid extensions for an image.
     *
     * @return mixed
     */
    public static function getValidExtensions()
    {
        return self::VALID_EXTENSIONS;
    }
}
