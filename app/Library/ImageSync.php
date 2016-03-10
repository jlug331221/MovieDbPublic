<?php
/**
 * Create by John on 3/1/2016
 */

namespace App\Library;

use DB;
use App\Image as Image;
use Exception;
use Image as InterventionImage;
use Illuminate\Support\Facades\File;

class ImageSync {

    /**
     * Creates an image record with an associated image file
     * in the filesystem.
     *
     * @param $file
     * @param null $description
     * @return Image|null
     * @throws Exception
     */
    public function create($file, $description = null)
    {
        if ( ! File::isFile($file))
            throw new Exception('Not a file');

        if ( ! Image::isValidExtension($file->getClientOriginalExtension()))
            throw new Exception('Not a valid file type');

        $image = null;

        DB::beginTransaction();

        try {
            // make a new record for the image in the database
            $image = new Image([
                'extension'   => $file->getClientOriginalExtension(),
                'description' => $description
            ]);
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

    /**
     * Deletes an image record if it exists along with the
     * associated image file in the filesystem.
     *
     * @param $id
     */
    public function destroy($id)
    {
        $image = Image::find($id);

        if ($image != null) {
            File::delete($image->getAbsolutePath());
            Image::destroy($id);
        }
    }
}