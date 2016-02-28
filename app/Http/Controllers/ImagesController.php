<?php

namespace App\Http\Controllers;

use App\Image;
use DB;
use App\Http\Requests\CreateImageRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image as ImageTool;

class ImagesController extends Controller {

    public function create()
    {
        return view('images.create');
    }

    public function store(CreateImageRequest $request)
    {
        DB::beginTransaction();

        try {
            // create the image record
            $image = new Image([
                'extension'   => $request->file('image')->getClientOriginalExtension(),
                'description' => $request->get('description')
            ]);
            $image->save();

            // generate the path for the record
            $image->path = $image->derivePathFromId();
            $image->save();

            // checks that the directory for the image exists, if not creating it
            $absoluteDir = public_path() . '/' . $image->path;
            if ( ! File::exists($absoluteDir)) {
                File::makeDirectory($absoluteDir);
            }

            // save the image to the directory
            $file = $request->file('image');
            $imageFile = ImageTool::make($file->getRealPath());
            $imageFile->save($image->getAbsolutePath());

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            // log this
        }

        DB::commit();

        return redirect($image->getPath());
    }
}
