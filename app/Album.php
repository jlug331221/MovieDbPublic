<?php

namespace App;

use DB;
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
     * @param $image
     * @return mixed
     */
    public function addImage($image)
    {
        return DB::table('album_image')->insert([
            'album_id' => $this->id,
            'image_id' => hex2bin($image->id)
        ]);
    }

    /**
     * Removes an image from the album.
     *
     * @param $image
     * @return mixed
     */
    public function removeImage($image)
    {
        return DB::table('album_image')
            ->where('album_id', '=', $this->id)
            ->where('image_id', '=', hex2bin($image->id))
            ->delete();
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
