<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests\CreateImageRequest;
use App\Http\Requests;

use Session;
use App\Movie;
use App\Person;
use App\Album;

use App\Image;
use Image as InterventionImage;
use ImageSync;

use Symfony\Component\HttpFoundation\File\UploadedFile as UploadedFile;

class ImagesController extends Controller {

    /**
     * Store image for a particular person.
     *
     * @param CreateImageRequest $request
     * @param $pid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePersonImage(CreateImageRequest $request, $pid)
    {
        $file = $request->file('image');
        $description = $request->get('description');

        try {
            $image = ImageSync::create($file, $description);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        $person = Person::find($pid);
        DB::table('album_image')->insert(['album_id' => $person->album,
                                          'image_id' => $image->id]);
        if ( ! Album::find($person->album)->default) {
            DB::table('albums')->where('id', $person->album)
                ->update(['default' => $image->id]);
        }
        return redirect('admin/showPerson/' . $person->id)->with('success',
            "Successfully uploaded image for " . $person->first_name
            . ' ' . $person->last_name);
    }

    /**
     * Delete image for a particular person.
     *
     * @param $pid
     * @param $imgId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroyPersonImage($pid, $imgId)
    {
        $person = Person::find($pid);
        if ($imgId === Album::find($person->album)->images->first()->id) {
            DB::table('albums')->where('id', $person->album)
                ->update(['default' => null]);
        }

        DB::table('album_image')->where('image_id', $imgId)->delete();
        DB::table('images')->where('id', $imgId)->delete();

        Session::flash('message', "Successfully deleted image for " . $person->first_name
            . ' ' . $person->last_name);
        return redirect('admin/showPerson/' . $person->id);
    }


    /**
     * Store image for a particular movie.
     *
     * @param CreateImageRequest $request
     * @param $mid
     * @return mixed
     */
    public function storeMovieImage(CreateImageRequest $request, $mid)
    {
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
        if ( ! Album::find($movie->album)->default) {
            DB::table('albums')->where('id', $movie->album)
                ->update(['default' => $image->id]);
        }
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
     * Album page for a person.
     *
     * @param integer $id Album id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get_personAlbum($id)
    {
        $person = Person::find($id);
        return view('albums/personAlbum', compact('person'));
    }

    /**
     * Album page for a movie.
     *
     * @param integer $id Album id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get_movieAlbum($id)
    {
        $movie = Movie::find($id);
        return view('albums/movieAlbum', compact('movie'));
    }

    /**
     * Returns a json response with the following information about
     * an album:
     *
     * {
     *     'default' : number // default image for the album
     *     'images' : [
     *         {
     *             'id' : number // id of the image
     *             'path' : string // path to the image
     *             'thumb' : string // path to the thumbnail of the image
     *             'description' : string // description of the image
     *         },
     *         ...
     *     ]
     * }
     *
     * @param integer $id Album id
     * @return array
     */
    public function get_album_json($id)
    {
        $album = Album::find($id);

        if ( ! $album)
            return \Response::json(['code' => 404, 'msg' => 'Album not found.']);

        $images = $album->images()->get();

        $images = $images->map(function ($image) {
            return [
                'id'          => $image->id,
                'path'        => $image->getPath(),
                'thumb'       => $image->getThumbPath(),
                'description' => $image->description,
            ];
        })->toArray();

        $json = [
            'default' => $album->default,
            'images'  => $images
        ];

        return $json;
    }
}
