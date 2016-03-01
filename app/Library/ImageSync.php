<?php
/**
 * Create by John on 3/1/2016
 */

namespace App\Library;

use DB;
use App\Image as Image;
use Image as InterventionImage;
use Illuminate\Support\Facades\File;

class ImageSync {

    protected $extensions = [
        'png',
        'jpeg',
        'jpg',
        'bmp'
    ];

    public function create($file, $description = null)
    {
        if ( ! is_file($file) || ! in_array($file->getClientOriginalExtension(), $this->extensions))
            throw new Exception('Not a valid file');

        $image = null;

        DB::beginTransaction();

        try {
            // create the image record
            $image = new Image([
                'extension'   => $file->getClientOriginalExtension(),
                'description' => $description
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
            $imageFile = InterventionImage::make($file->getRealPath());
            $imageFile->save($image->getAbsolutePath());

        } catch (\Exception $e) {
            DB::rollBack();

            throw new Exception('Unable to upload file.');
        }

        DB::commit();

        return $image;
    }

//    public function destroy($id)
//    {
//        $image = Image::findOrFail($id);
//
//        // File::delete
//    }
}