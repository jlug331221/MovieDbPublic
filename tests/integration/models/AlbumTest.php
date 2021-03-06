<?php /** Created by John on 3/2/2016 */

use App\Album;
use App\Image as Image;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AlbumTest extends TestCase {

    use DatabaseTransactions;

    public $album;

    public function setUp()
    {
        parent::setUp();

        $this->album = factory(Album::class)->create();
    }

    // REQ-ID: 62
    // Test-ID: 1
    /** @test */
    public function it_can_add_an_image_to_an_album_using_an_image()
    {
        $image = factory(Image::class)->create();
        $this->album->addImage($image);

        $albumImages = $this->album->images()->get();

        $this->album->removeAll();
        $this->assertEquals(1, count($albumImages));
    }

    // REQ-ID: 62
    // Test-ID: 2
    /** @test */
    public function it_can_add_an_image_to_an_album_using_an_image_id()
    {
        $image = factory(Image::class)->create();
        $this->album->addImage($image->id);

        $albumImages = $this->album->images()->get();

        $this->assertEquals(1, count($albumImages));
    }

    // REQ-ID: 62
    // Test-ID: 3
    /** @test */
    public function it_throws_an_exception_when_adding_on_invalid_param()
    {
        try {
            $this->album->addImage('image');
        } catch (\Exception $e) {
            $this->assertEquals('Could not add image. Invalid parameter', $e->getMessage());
            return;
        }

        $this->fail();
    }

    // REQ-ID: 62
    // Test-ID: 4
    /** @test */
    public function it_can_add_to_an_album_using_an_array_of_images()
    {
        $imageOne = factory(Image::class)->create();
        $imageTwo = factory(Image::class)->create();
        $imageThree = factory(Image::class)->create();
        $images = [$imageOne, $imageTwo, $imageThree];
        $this->album->addImages($images);

        $albumImages = $this->album->images()->get();

        $this->assertEquals(3, count($albumImages));
    }

    // REQ-ID: 62
    // Test-ID: 5
    /** @test */
    public function it_can_add_to_an_album_using_an_array_of_image_ids()
    {
        $imageOne = factory(Image::class)->create();
        $imageTwo = factory(Image::class)->create();
        $imageThree = factory(Image::class)->create();
        $imageIds = [$imageOne->id, $imageTwo->id, $imageThree->id];
        $this->album->addImages($imageIds);

        $albumImages = $this->album->images()->get();

        $this->assertEquals(3, count($albumImages));
    }

    // REQ-ID: 62
    // Test-ID: 6
    /** @test */
    public function it_can_remove_an_image_from_an_album_using_an_image()
    {
        $image = factory(Image::class)->create();
        $this->album->addImage($image);

        $albumImages = $this->album->images()->get();

        $this->assertEquals(1, count($albumImages));

        $this->album->removeImage($image);

        $albumImages = $this->album->images()->get();

        $this->assertEquals(0, count($albumImages));
    }

    // REQ-ID: 62
    // Test-ID: 7
    /** @test */
    public function it_can_remove_an_image_from_an_album_using_an_image_id()
    {
        $image = factory(Image::class)->create();
        $this->album->addImage($image);

        $albumImages = $this->album->images()->get();

        $this->assertEquals(1, count($albumImages));

        $this->album->removeImage($image->id);

        $albumImages = $this->album->images()->get();

        $this->assertEquals(0, count($albumImages));
    }

    // REQ-ID: 62
    // Test-ID: 8
    /** @test */
    public function it_throws_an_exception_when_removing_on_invalid_param()
    {
        $image = factory(Image::class)->create();
        $this->album->addImage($image);

        $albumImages = $this->album->images()->get();

        $this->assertEquals(1, count($albumImages));

        try {
            $this->album->removeImage('image');
        } catch (\Exception $e) {
            $this->assertEquals('Could not remove image. Invalid parameter', $e->getMessage());
            return;
        }

        $this->fail();
    }

    // REQ-ID: 62
    // Test-ID: 9
    /** @test */
    public function it_can_remove_from_an_album_using_an_array_of_images()
    {
        $imageOne = factory(Image::class)->create();
        $imageTwo = factory(Image::class)->create();
        $imageThree = factory(Image::class)->create();
        $images = [$imageOne, $imageTwo, $imageThree];
        $this->album->addImages($images);

        $albumImages = $this->album->images()->get();

        $this->assertEquals(3, count($albumImages));

        array_pop($images);

        $this->album->removeImages($images);

        $albumImages = $this->album->images()->get();

        $this->assertEquals(1, count($albumImages));
    }

    // REQ-ID: 62
    // Test-ID: 10
    /** @test */
    public function it_can_remove_from_an_album_using_an_array_of_image_ids()
    {
        $imageOne = factory(Image::class)->create();
        $imageTwo = factory(Image::class)->create();
        $imageThree = factory(Image::class)->create();
        $imageIds = [$imageOne->id, $imageTwo->id, $imageThree->id];
        $this->album->addImages($imageIds);

        $albumImages = $this->album->images()->get();

        $this->assertEquals(3, count($albumImages));

        array_pop($imageIds);

        $this->album->removeImages($imageIds);

        $albumImages = $this->album->images()->get();

        $this->assertEquals(1, count($albumImages));
    }

    // REQ-ID: 62
    // Test-ID: 11
    /** @test */
    public function it_can_remove_all_of_the_images_from_the_album()
    {
        $imageOne = factory(Image::class)->create();
        $imageTwo = factory(Image::class)->create();
        $imageThree = factory(Image::class)->create();
        $imageIds = [$imageOne->id, $imageTwo->id, $imageThree->id];
        $this->album->addImages($imageIds);

        $albumImages = $this->album->images()->get();

        $this->assertEquals(3, count($albumImages));

        $this->album->removeAll();

        $albumImages = $this->album->images()->get();

        $this->assertEquals(0, count($albumImages));
    }

    // REQ-ID: 99
    // Test-ID: 12
    /** @test */
    public function it_has_no_default_image_on_creation()
    {
        $this->assertNull($this->album->default);
    }

    // REQ-ID: 99
    // Test-ID: 13
    /** @test */
    public function it_can_change_the_default_image_using_an_instance_of_an_image()
    {
        $this->assertNull($this->album->default);

        $image = factory(Image::class)->create();
        $this->album->addImage($image->id);

        $this->album->changeDefault($image);
        $album = Album::first();
        $this->assertEquals($album->default, $image->id);
    }

    // REQ-ID: 99
    // Test-ID: 14
    /** @test */
    public function it_can_change_the_default_image_using_an_id()
    {
        $this->assertNull($this->album->default);

        $image = factory(Image::class)->create();
        $this->album->addImage($image->id);

        $this->album->changeDefault($image->id);
        $album = Album::first();
        $this->assertEquals($album->default, $image->id);
    }

    // REQ-ID: 99
    // Test-ID: 15
    /** @test */
    public function it_can_set_the_default_image_to_null()
    {
        $this->assertNull($this->album->default);

        $image = factory(Image::class)->create();
        $this->album->addImage($image->id);

        $this->album->changeDefault($image->id);
        $album = Album::first();
        $this->assertEquals($album->default, $image->id);

        $this->album->changeDefault();
        $album = Album::first();
        $this->assertNull($album->default);
    }

    // REQ-ID: 99
    // Test-ID: 16
    /** @test */
    public function it_throws_an_exception_when_setting_the_default_image_with_an_invalid_param()
    {
        try {
            $this->album->changeDefault('image');
        } catch (\Exception $e) {
            $this->assertEquals('Could not change default image. Invalid parameter', $e->getMessage());
            return;
        }

        $this->fail();
    }

    // REQ-ID: 99
    // Test-ID: 17
    /** @test */
    public function it_removes_the_default_image_when_all_images_are_cleared()
    {
        $image = factory(Image::class)->create();
        $this->album->addImage($image->id);

        $this->album->changeDefault($image->id);
        $this->assertEquals($this->album->default, $image->id);

        $this->album->removeAll();
        $this->assertNull($this->album->default);
    }
}
