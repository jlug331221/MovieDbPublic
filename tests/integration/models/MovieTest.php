<?php /** Created by John on 4/10/2016 */

use App\Movie;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MovieTest extends TestCase {

    use DatabaseTransactions;

    // REQ-ID: 101
    /** @test */
    public function it_creates_an_associated_album_whenever_a_movie_is_created()
    {
        $movie = new Movie();
        $movie->title = 'The Good, The Bad and the Ugly';
        $movie->country = 'Italy';
        $movie->release_date = '1967-12-29';
        $movie->genre = 'Western';
        $movie->runtime = 161;
        $movie->save();

        $album = $movie->album()->firstOrFail();

        $this->assertNotNull($movie->album);
        $this->assertNotNull($album);
        $this->assertEquals($movie->album, $album->id);
    }

    // REQ-ID: 105
    /** @test */
    public function it_stores_all_of_the_alpha_numeric_suffixes_per_word_of_a_movies_title_on_creation()
    {
        $movie = new Movie();
        $movie->title = 'The Good, The Bad and the Ugly';
        $movie->country = 'Italy';
        $movie->release_date = '1967-12-29';
        $movie->genre = 'Western';
        $movie->runtime = 161;
        $movie->save();

        $id = $movie->id;

        $r = DB::table('movie_suffixes')->where('title_suffix', '=', 'The Good The Bad and the Ugly')->first();
        $this->assertEquals($id, $r->movie_id);
        $r = DB::table('movie_suffixes')->where('title_suffix', '=', 'Good The Bad and the Ugly')->first();
        $this->assertEquals($id, $r->movie_id);
        $r = DB::table('movie_suffixes')->where('title_suffix', '=', 'The Bad and the Ugly')->first();
        $this->assertEquals($id, $r->movie_id);
        $r = DB::table('movie_suffixes')->where('title_suffix', '=', 'Bad and the Ugly')->first();
        $this->assertEquals($id, $r->movie_id);
        $r = DB::table('movie_suffixes')->where('title_suffix', '=', 'and the Ugly')->first();
        $this->assertEquals($id, $r->movie_id);
        $r = DB::table('movie_suffixes')->where('title_suffix', '=', 'the Ugly')->first();
        $this->assertEquals($id, $r->movie_id);
        $r = DB::table('movie_suffixes')->where('title_suffix', '=', 'Ugly')->first();
        $this->assertEquals($id, $r->movie_id);
    }

    // REQ-ID: 105
    /** @test */
    public function it_updates_all_of_the_suffixes_of_a_movies_name_on_update()
    {
        $movie = new Movie();
        $movie->title = 'The Force Awakens';
        $movie->country = 'United States';
        $movie->release_date = '2015-12-25';
        $movie->genre = 'Action';
        $movie->runtime = 161;
        $movie->save();

        $id = $movie->id;

        $r = DB::table('movie_suffixes')->where('title_suffix', '=', 'The Force Awakens')->first();
        $this->assertEquals($id, $r->movie_id);
        $r = DB::table('movie_suffixes')->where('title_suffix', '=', 'Force Awakens')->first();
        $this->assertEquals($id, $r->movie_id);
        $r = DB::table('movie_suffixes')->where('title_suffix', '=', 'Awakens')->first();
        $this->assertEquals($id, $r->movie_id);

        $movie->title = 'Rogue One';
        $movie->save();

        $this->assertNull(DB::table('movie_suffixes')->where('title_suffix', '=', 'The Force Awakens')->first());
        $this->assertNull(DB::table('movie_suffixes')->where('title_suffix', '=', 'Force Awakens')->first());
        $this->assertNull(DB::table('movie_suffixes')->where('title_suffix', '=', 'Awakens')->first());

        $r = DB::table('movie_suffixes')->where('title_suffix', '=', 'Rogue One')->first();
        $this->assertEquals($id, $r->movie_id);
        $r = DB::table('movie_suffixes')->where('title_suffix', '=', 'One')->first();
        $this->assertEquals($id, $r->movie_id);
    }

    // REQ-ID: 105
    /** @test */
    public function it_deletes_all_suffixes_associated_with_a_movie_on_deletion()
    {
        $movie = new Movie();
        $movie->title = 'The Force Awakens';
        $movie->country = 'United States';
        $movie->release_date = '2015-12-25';
        $movie->genre = 'Action';
        $movie->runtime = 161;
        $movie->save();

        $id = $movie->id;

        $r = DB::table('movie_suffixes')->where('title_suffix', '=', 'The Force Awakens')->first();
        $this->assertEquals($id, $r->movie_id);
        $r = DB::table('movie_suffixes')->where('title_suffix', '=', 'Force Awakens')->first();
        $this->assertEquals($id, $r->movie_id);
        $r = DB::table('movie_suffixes')->where('title_suffix', '=', 'Awakens')->first();
        $this->assertEquals($id, $r->movie_id);

        $movie->delete();

        $this->assertNull(DB::table('movie_suffixes')->where('title_suffix', '=', 'The Force Awakens')->first());
        $this->assertNull(DB::table('movie_suffixes')->where('title_suffix', '=', 'Force Awakens')->first());
        $this->assertNull(DB::table('movie_suffixes')->where('title_suffix', '=', 'Awakens')->first());
    }
}
