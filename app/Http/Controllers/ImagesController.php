<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests\CreateImageRequest;
use App\Http\Requests;

use App\Image;
use Faker\Factory;
use Image as InterventionImage;
use ImageSync;

use Symfony\Component\HttpFoundation\File\UploadedFile as UploadedFile;

class ImagesController extends Controller {

    /**
     * Go to the image creation page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('images.create');
    }

    /**
     * Go to the image deletion page.
     *
     * @param $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function delete($name)
    {
        $image = Image::where('name', '=', $name)->first();
        if ($image != null) {
            return view('images.delete', compact('image'));
        } else {
            return redirect()->action('HomeController@index');
        }
    }

    /**
     * Store an image in the database/filesystem.
     *
     * @param CreateImageRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateImageRequest $request)
    {
        $file = $request->file('image');
        $description = $request->get('description');

        try {
            $image = ImageSync::create($file, $description);
        } catch (\Exception $e) {
            dd($e->getMessage());
            // do something here like log the error.
        }

        return redirect($image->getPath());
    }

    /**
     * Discard an image from the database/filesystem.
     *
     * @param $name
     * @return \Illuminate\Http\RedirectResponse
     */
    public function discard($name)
    {
        $image = Image::where('name', '=', $name)->first();
        if ($image != null)
            ImageSync::destroy($image->id);

        return redirect()->action('ImagesController@create');
    }
}
