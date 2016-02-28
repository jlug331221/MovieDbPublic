<?php

namespace App\Http\Controllers;

use App\Image;
use DB;
use App\Http\Requests\CreateImageRequest;
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
            $image = new Image([
                'extension'   => $request->file('ima2ge')->getClientOriginalExtension(),
                'description' => $request->get('description'),
                'path'        => '/images'
            ]);
            $image->save();

            $file = $request->file('image');
            $imageFile = ImageTool::make($file->getRealPath());
            $imageFile->save($image->getAbsolutePath());

        } catch (\Exception $e) {
            DB::rollBack();
            // log this
        }

        DB::commit();

        return redirect('images/' . $image->getName());
    }
}
