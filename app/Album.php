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
     * Adds an image to the album.
     *
     * @param Image $image
     */
    public function addImage($image)
    {
        return $this->images()->attach($image);
    }

    /**
     * Removes an image from the album.
     *
     * @param $image
     * @return int
     */
    public function removeImage($image)
    {
        return $this->images()->detach($image);
    }

    /**
     * Adds each image in the array to the album.
     *
     * @param array $images
     */
    public function addImages($images)
    {
        if (is_array($images))
            array_map('addImage', $images);
    }

    /**
     * Removes each image in the array from the album.
     *
     * @param array $images
     */
    public function removeImages($images)
    {
        if(is_array($images))
            array_map('removeImage', $images);
    }
}
