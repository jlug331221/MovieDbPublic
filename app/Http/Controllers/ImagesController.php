<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests\CreateImageRequest;
use App\Http\Requests;

use App\Image;
use Image as InterventionImage;
use ImageSync;

class ImagesController extends Controller {

    public function create()
    {
        return view('images.create');
    }

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

//    public function delete()
//    {
//
//    }
}
