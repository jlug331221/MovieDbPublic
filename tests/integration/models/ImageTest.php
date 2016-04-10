<?php /** Create by John on 2/24/2016 */

use App\Image as Image;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ImageTest extends TestCase {

    use DatabaseTransactions;

    /** @test */
    public function it_can_return_the_name_of_the_file()
    {
        $image = factory(Image::class)->create();

        $name = $image->name;
        $extension = $image->extension;
        $fileName = $name . '.' . $extension;

        $this->assertEquals($fileName, $image->getFileName());
    }

    /** @test */
    public function it_can_return_the_path_of_the_image_from_the_public_directory()
    {
        $image = factory(Image::class)->create();

        $subdirectory = substr(md5(intval($image->id / Image::IMAGES_PER_SUBDIRECTORY)), 0, 8);
        $path = Image::IMAGE_DIRECTORY . '/' . $subdirectory . '/' . $image->name . '.' . $image->extension;

        $this->assertEquals($path, $image->getPath());
    }


    /** @test */
    public function it_can_return_the_path_of_the_image_thumb_from_the_public_directory()
    {
        $image = factory(Image::class)->create();

        $subdirectory = substr(md5(intval($image->id / Image::IMAGES_PER_SUBDIRECTORY)), 0, 8);
        $path = Image::IMAGE_DIRECTORY . '/' . $subdirectory . '/thumbs/' . $image->name . '.' . $image->extension;

        $this->assertEquals($path, $image->getThumbPath());
    }

    /** @test */
    public function it_can_return_the_absolute_path_of_an_image()
    {
        $image = factory(Image::class)->create();

        $subdirectory = substr(md5(intval($image->id / Image::IMAGES_PER_SUBDIRECTORY)), 0, 8);
        $path = public_path() . Image::IMAGE_DIRECTORY . '/' . $subdirectory . '/' . $image->name . '.' . $image->extension;

        $this->assertEquals($path, $image->getAbsolutePath());
    }

    /** @test */
    public function it_can_return_the_absolute_path_of_an_image_thumb()
    {
        $image = factory(Image::class)->create();

        $subdirectory = substr(md5(intval($image->id / Image::IMAGES_PER_SUBDIRECTORY)), 0, 8);
        $path = public_path() . Image::IMAGE_DIRECTORY . '/' . $subdirectory . '/thumbs/' . $image->name . '.' . $image->extension;

        $this->assertEquals($path, $image->getAbsoluteThumbPath());
    }

    /** @test */
    public function it_can_verify_valid_file_extensions()
    {
        $validExtensions = Image::getValidExtensions();

        array_map(function ($extension) {
            $this->assertTrue(Image::isValidExtension($extension));
        }, $validExtensions);
    }

    public function it_can_reject_invalid_file_extensions()
    {
        $validExtensions = Image::getValidExtensions();
        $invalidExtensions = ['pdf', 'bpg', 'webm', 'svg'];

        array_map(function ($extension) use ($validExtensions) {
            $this->assertNotContains($extension, $validExtensions);
            $this->assertNotTrue(Image::isValidExtension($extension));
        }, $invalidExtensions);
    }
}
