<?php /** Created by John on 3/2/2016 */

use App\Image as Image;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageSyncTest extends TestCase {

    use DatabaseTransactions;

    // REQ-ID: 55
    /** @test */
    public function it_can_create_a_record_and_corresponding_file()
    {
        $imageFile = $this->set_up_image_file();

        // create the record and corresponding file
        $image = ImageSync::create($imageFile, 'test case image');

        $id = $image->id;

        // assert record exists in the table
        $record = Image::find($id);
        $this->assertTrue($record != null);

        // assert record corresponds to a file on the file system
        $path = $record->getAbsolutePath();
        $this->assertTrue(file_exists($path));

        $this->tear_down_image_file($image);
    }

    // REQ-ID: 60
    /** @test */
    public function it_can_delete_a_record_and_corresponding_file()
    {
        $imageFile = $this->set_up_image_file();

        $image = ImageSync::create($imageFile, 'test case image');

        $this->assertTrue(Image::find($image->id) != null);
        $this->assertTrue(file_exists($image->getAbsolutePath()));

        ImageSync::destroy($image->id);

        $this->assertNotTrue(Image::find($image->id) != null);
        $this->assertNotTrue(file_exists($image->getAbsolutePath()));
    }

    // REQ-ID: 59
    /** @test */
    public function it_throws_an_exception_for_non_file_types_during_creation()
    {
        $string = 'test case string';

        try {
            ImageSync::create($string);
        } catch (\Exception $e) {
            $this->assertEquals('Not a file', $e->getMessage());
            return;
        }

        $this->fail();
    }

    // REQ-ID: 57, 59
    /** @test */
    public function it_throws_an_exception_for_invalid_file_extensions_during_creation()
    {
        $faker = Factory::create();

        // generate a random temporary image
        $tmp = $faker->image($dir = '/tmp', $width = 40, $height = 30);

        // generate an UploadedFile to mock the user's uploaded image
        return new UploadedFile($tmp, 'testcase.bad', mime_content_type($tmp), filesize($tmp));

        try {
            ImageSync::create($string);
        } catch (\Exception $e) {
            $this->assertEquals('Not a valid file type', $e->getMessage());
            return;
        }

        $this->fail();
    }

    private function set_up_image_file()
    {
        $faker = Factory::create();

        // generate a random temporary image
        $tmp = $faker->image($dir = '/tmp', $width = 40, $height = 30);

        // generate an UploadedFile to mock the user's uploaded image
        return new UploadedFile($tmp, 'testcase.jpg', mime_content_type($tmp), filesize($tmp));
    }

    private function tear_down_image_file($image)
    {
        // clean up by deleting file
        unlink($image->getAbsolutePath());
    }
}
