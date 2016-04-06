<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests\CreateImageRequest;
use App\Http\Requests;

use Session;
use App\Movie;
use App\Album;

use App\Image;
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
     * Store image for a particular movie.
     *
     * @param CreateImageRequest $request
     * @param $mid
     * @return mixed
     */
    public function storeMovieImage(CreateImageRequest $request, $mid) {
        $file = $request->file('image');
        $description = $request->get('description');

        try {
            $image = ImageSync::create($file, $description);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        $movie = Movie::find($mid);
        DB::table('album_image')->insert(['album_id' => $movie->album,
            'image_id' => $image->id]);
        if(!Album::find($movie->album)->default) {
            DB::table('albums')->where('id', $movie->album)
                ->update(['default' => $image->id]);
        }

        //Session::flash('UploadMessage', "Successfully uploaded image for " . $movie->title);
        return redirect('admin/showMovie/' . $movie->id)->with('success',
            "Successfully uploaded image for " . $movie->title);
    }


    /**
     * Delete image for a particular movie.
     *
     * @param $mid
     * @param $imgId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroyMovieImage($mid, $imgId)
    {
        $movie = Movie::find($mid);
        if ($imgId === Album::find($movie->album)->images->first()->id) {
            DB::table('albums')->where('id', $movie->album)
                ->update(['default' => null]);
        }

        DB::table('album_image')->where('image_id', $imgId)->delete();
        DB::table('images')->where('id', $imgId)->delete();

        Session::flash('message', "Successfully deleted image for " . $movie->title);
        return redirect('admin/showMovie/' . $movie->id);
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
