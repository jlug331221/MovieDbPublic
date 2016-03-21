<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model {

    /**
     * An album can contain many images.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function images()
    {
        return $this->belongsToMany('App\Image');
    }

    /**
     * An album has one default image.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function defaultImage()
    {
        return $this->hasOne('App\Image', 'id', 'default');
    }

    /**
     * Changes the default image for the album using an Image or an id.
     *
     * @param Image | integer $image
     */
    public function changeDefault($image)
    {
        if ($image instanceof Image)
            $image = $image->id;

        if (is_numeric($image))
            $this->default = $image;
    }

    /**
     * Adds an image to the album using an Image or an id.
     *
     * @param Image | integer $image
     */
    public function addImage($image)
    {
        if ($image instanceof Image)
            $image = $image->id;

        if (is_numeric($image))
            return $this->images()->attach($image);
    }

    /**
     * Removes an image from the album using am Image or an id.
     *
     * @param Image | integer $image
     * @return int
     */
    public function removeImage($image)
    {
        if ($image instanceof Image)
            $image = $image->id;

        if (is_numeric($image))
            return $this->images()->detach($image);
    }

    /**
     * Adds each image in the array to the album. Array may contain
     * Images or id numbers.
     *
     * @param Image[] | integer[] | mixed[] $images
     */
    public function addImages($images)
    {
        if (is_array($images)) {
            array_map(function ($image) {
                $this->addImage($image);
            }, $images);
        }
    }

    /**
     * Removes each image in the array from the album. Array may
     * contain Images or id numbers.
     *
     * @param Image[] | integer[] | mixed[] $images
     */
    public function removeImages($images)
    {
        if (is_array($images)) {
            array_map(function ($image) {
                $this->removeImage($image);
            }, $images);
        }
    }

    /**
     * Removes all of the images from the album.
     *
     * @return int
     */
    public function removeAll()
    {
        $this->default = null;
        return $this->images()->detach();
    }
}
