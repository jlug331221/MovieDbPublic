<?php
/**
 * Create by John on 3/1/2016
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ImageSyncFacade extends Facade{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'imagesync';
    }
}