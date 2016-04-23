<?php /** Created by John on 4/11/2016 */

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ImagesControllerTest extends TestCase {

    use DatabaseTransactions;

    // REQ-ID: 97
    // Test-ID: 1
    /** @test */
    public function it_can_get_album_info_as_json_in_a_specific_format()
    {
        $id = $this->seedAlbumAndImages();

        $class = App::make('App\Http\Controllers\ImagesController');

        $actual = $class->get_album_json($id);

        $expected = [
            'default' => 1,
            'images' => [
                ['id' => 1, 'path' => 'img/img1.png', 'thumb' => 'img/thumbs/img1.png', 'description' => 'image 1'],
                ['id' => 2, 'path' => 'img/img2.jpg', 'thumb' => 'img/thumbs/img2.jpg', 'description' => 'image 2'],
                ['id' => 3, 'path' => 'img/img3.png', 'thumb' => 'img/thumbs/img3.png', 'description' => 'image 3'],
            ]
        ];

        $this->assertEquals($expected, $actual);
    }

    // REQ-ID: 97
    // Test-ID: 2
    /** @test */
    public function it_returns_404_when_requesting_json_for_a_nonexistent_album()
    {
        $class = App::make('App\Http\Controllers\ImagesController');

        $actual = $class->get_album_json(1);

        $this->assertEquals(\Response::json(['code' => 404, 'msg' => 'Album not found.']), $actual);
    }

    // REQ-ID: 97
    // Test-ID: 3
    /** @test */
    public function it_returns_null_fields_for_an_album_without_any_images()
    {
        $album = new App\Album();
        $album->save();

        $class = App::make('App\Http\Controllers\ImagesController');

        $actual = $class->get_album_json($album->id);

        $expected = ['default' => null, 'images' => []];

        $this->assertEquals($expected, $actual);
    }


    private function seedAlbumAndImages()
    {
        $album = new App\Album();
        $album->save();

        $img1 = App\Image::create(['extension' => 'png', 'description' => 'image 1']);
        $img1->id = 1; $img1->path = 'img'; $img1->name = 'img1'; $img1->save();
        $img2 = App\Image::create(['extension' => 'jpg', 'description' => 'image 2']);
        $img2->id = 2; $img2->path = 'img'; $img2->name = 'img2'; $img2->save();
        $img3 = App\Image::create(['extension' => 'png', 'description' => 'image 3']);
        $img3->id = 3; $img3->path = 'img'; $img3->name = 'img3'; $img3->save();

        $album->addImages([$img1, $img2, $img3]);

        $album->changeDefault($img1);

        return $album->id;
    }
}
