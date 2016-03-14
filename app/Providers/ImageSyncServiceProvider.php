<?php /** Created by John on 3/1/16 */

namespace App\Providers;

use App\Library\ImageSync;
use Illuminate\Support\ServiceProvider;

class ImageSyncServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('imagesync', function($app) {
            return new ImageSync($app);
        });
    }
}
