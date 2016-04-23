<?php

use App\Album;
use App\Character;
use App\Discussion;
use App\Image;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use App\Movie;
use App\Person;
use App\Review;

class AdminControllerTest extends TestCase {

    use DatabaseTransactions;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();
    }

    // Req-ID: 17
    // Test-ID: 1
    /** @test */
    public function it_has_a_form_to_fill_out_movie_information_to_be_inserted_into_the_database()
    {
        $errors = null;
        $this->visit('admin/createMovie', compact($errors))
            ->type('The Terminator', 'title')
            ->select('United States', 'country')
            ->type('06/02/1984', 'release_date')
            ->select('Sci-Fi', 'genre')
            ->select('R', 'parental_rating')
            ->type('110', 'runtime')
            ->type('The best movie in the terminator franchise', 'synopsis')
            ->press('Create Movie')
            ->seePageIs('/admin/showAllMovies', compact($errors))
            ->assertSessionHas('success', 'Successfully added movie to database!');

        // Verify that the movie is in the database with all the correct
        // form information.
        $this->seeInDatabase('movies', ['title'    => 'The Terminator',
                                        'country'  => 'United States', 'release_date' => '1984-06-02',
                                        'genre'    => 'Sci-Fi', 'parental_rating' => 'R', 'runtime' => '110',
                                        'synopsis' => 'The best movie in the terminator franchise']);
    }

    // Req-ID: 18
    // Test-ID: 2
    /** @test */
    public function it_has_a_form_to_fill_out_person_information_to_be_inserted_into_the_database()
    {
        $errors = null;
        $this->visit('admin/createPerson', compact($errors))
            ->type('Tommy', 'first_name')
            ->type('Justin', 'middle_name')
            ->type('Yeti', 'last_name')
            ->type('Oprah', 'first_alias')
            ->type('Dan', 'middle_alias')
            ->type('Pickle', 'last_alias')
            ->select('Angola', 'country_of_origin')
            ->type('05/05/2000', 'date_of_birth')
            ->type('05/06/2000', 'date_of_death')
            ->type('This person has a biography.', 'biography')
            ->press('Create Person')
            ->seePageIs('/admin/showAllPeople', compact($errors))
            ->assertSessionHas('success', 'Successfully added person to database!');

        // Verify that the person is in the database with all the correct
        // form information.
        $this->seeInDatabase('people', ['first_name'    => 'Tommy',
                                        'middle_name'   => 'Justin', 'last_name' => 'Yeti', 'first_alias' => 'Oprah',
                                        'middle_alias'  => 'Dan', 'last_alias' => 'Pickle', 'country_of_origin' => 'Angola',
                                        'date_of_birth' => '2000-05-05', 'date_of_death' => '2000-05-06',
                                        'biography'     => 'This person has a biography.']);
    }

    // Req-ID: 18.5
    // Test-ID: 3
    /** @test */
    public function it_has_a_form_to_fill_out_character_information_to_be_inserted_into_the_database()
    {
        $errors = null;
        $this->visit('admin/createCharacter', compact($errors))
            ->type('Justin', 'character_name')
            ->type('Blah blah blah', 'biography')
            ->press('Create Character')
            ->seePageIs('/admin/createCharacter', compact($errors))
            ->assertSessionhas('success', 'Successfully added character to database!');

        // Verify that the character is in the database with all the correct
        // form information
        $this->seeInDatabase('characters', ['character_name' => 'Justin',
                                            'biography'      => 'Blah blah blah']);
    }

    // Req-ID: 19
    // Test-ID: 4
    /** @test */
    public function it_can_edit_a_movie_after_information_has_been_pulled_from_the_database()
    {
        $errors = null;

        // Needed to create an album first because of foreign key constraint
        // between a movie and an album
        DB::table('albums')->insert([
            ['id' => 1],
            ['id' => 2],
            ['id' => 3]
        ]);

        // Put people into the database for testing cast and crew
        DB::table('people')->insert([
            [
                'first_name'        => 'Justin',
                'middle_name'       => 'Ragnar',
                'last_name'         => 'Odin',
                'first_alias'       => 'Loki',
                'middle_alias'      => 'Orpheus',
                'last_alias'        => 'Eurydice',
                'country_of_origin' => 'United States',
                'date_of_birth'     => '1995-12-22',
                'date_of_death'     => '1996-12-23',
                'biography'         => 'This is a biography',
                'album'             => 1
            ],

            [
                'first_name'        => 'Mars',
                'middle_name'       => 'Venus',
                'last_name'         => 'Mercury',
                'first_alias'       => 'Neptune',
                'middle_alias'      => 'Jupiter',
                'last_alias'        => 'Saturn',
                'country_of_origin' => 'Canada',
                'date_of_birth'     => '1995-12-25',
                'date_of_death'     => '1996-12-25',
                'biography'         => 'This is another biography',
                'album'             => 2
            ]
        ]);

        $actor = Person::first();
        $director = Person::all()->last();

        // Put a film into the database for testing purposes. Obviously
        // it is The Terminator.
        DB::table('movies')->insert([
            'title'           => 'The Terminator',
            'country'         => 'Afghanistan',
            'release_date'    => '1984-10-26',
            'genre'           => 'Sci-Fi',
            'parental_rating' => 'G',
            'runtime'         => '100',
            'synopsis'        => 'The best terminator film ever!',
            'album'           => 3
        ]);

        $movie = Movie::first();

        // Create a character
        DB::table('characters')->insert([
            'character_name' => 'Awesome Opossum',
            'biography'      => 'Best character ever'
        ]);

        $character = Character::first();

        DB::table('credit_types')->insert([
            [
                'id'   => 1,
                'type' => 'Director'
            ],

            [
                'id'   => 2,
                'type' => 'Cast'
            ]
        ]);

        DB::table('credits')->insert([
            [
                'movie_id'       => $movie->id,
                'person_id'      => $actor->id,
                'credit_type_id' => 2,
                'character_id'   => $character->id
            ],

            [
                'movie_id'       => $movie->id,
                'person_id'      => $director->id,
                'credit_type_id' => 1,
                'character_id'   => null
            ]
        ]);

        $cast = DB::table('movies')
            ->join('credits', 'id', '=', 'movie_id')
            ->join('people', 'person_id', '=', 'people.id')
            ->join('albums', 'people.album', '=', 'albums.id')
            ->join('credit_types', 'credits.credit_type_id', '=', 'credit_types.id')
            ->leftJoin('images', 'albums.default', '=', 'images.id')
            ->join('characters', 'character_id', '=', 'characters.id')
            ->where('movie_id', '=', $movie->id)
            ->where('type', '=', 'Cast')
            ->get();

        $crew = DB::table('movies')
            ->join('credits', 'id', '=', 'movie_id')
            ->join('people', 'person_id', '=', 'people.id')
            ->join('albums', 'people.album', '=', 'albums.id')
            ->join('credit_types', 'credits.credit_type_id', '=', 'credit_types.id')
            ->leftJoin('images', 'albums.default', '=', 'images.id')
            ->where('movie_id', '=', $movie->id)
            ->where('type', '!=', 'Cast')
            ->get();

        $this->visit('admin/showAllMovies')
            ->click('movie_link')
            ->seePageIs('admin/showMovie/' . $movie->id, compact($cast, $crew, $errors))
            ->see('Editing Movie: The Terminator')
            ->see('The Terminator')
            ->see('Afghanistan')
            ->see('10/26/1984')
            ->see('Sci-Fi')
            ->see('G')
            ->see('100')
            ->see('The best terminator film ever!')
            ->see('Justin')
            ->see('Odin')
            ->see('Awesome Opossum')
            ->see('Mars')
            ->see('Mercury')
            ->see('Director')
            ->type('Terminator 2', 'title')
            ->select('United States', 'country')
            ->press('Update Movie')
            ->seePageIs('/admin/showAllMovies')
            ->assertSessionHas('success', 'Successfully updated movie in database!');
    }

    // Req-ID: 20
    // Test-ID: 5
    /** @test */
    public function it_can_edit_a_person_after_information_has_been_pulled_from_the_database()
    {
        $errors = null;

        // Needed to create an album first because of foreign key constraint
        // between a person and an album
        DB::table('albums')->insert([
            'id' => 1
        ]);

        // Put a person into the database for testing purposes.
        DB::table('people')->insert([
            'first_name'        => 'Justin',
            'middle_name'       => 'Ragnar',
            'last_name'         => 'Odin',
            'first_alias'       => 'Loki',
            'middle_alias'      => 'Orpheus',
            'last_alias'        => 'Eurydice',
            'country_of_origin' => 'United States',
            'date_of_birth'     => '1995-12-22',
            'date_of_death'     => '1996-12-23',
            'biography'         => 'This is a biography',
            'album'             => 1
        ]);

        $person = Person::first();
        $this->visit('admin/showAllPeople')
            ->click('person_name_link')
            ->seePageIs('admin/showPerson/' . $person->id, compact($errors))
            ->see('Justin')
            ->see('Ragnar')
            ->see('Odin')
            ->see('Loki')
            ->see('Orpheus')
            ->see('Eurydice')
            ->see('United States')
            ->see('12/22/1995')
            ->see('12/23/1996')
            ->see('This is a biography')
            ->type('Lokiiiiiiiiiii', 'first_alias')
            ->type('I am changing the biography of Justin', 'biography')
            ->press('Update Person')
            ->seePageIs('admin/showAllPeople')
            ->assertSessionHas('success', 'Successfully updated person in database!');
    }

    // Req-ID: 21
    // Test-ID: 6
    /** @test */
    public function
    it_can_properly_delete_a_movie_from_the_database_along_with_associated_reviews_and_discussions_and_album_and_images()
    {
        DB::table('albums')->insert([
            'id' => 1
        ]);

        $movie_album = Album::first();

        // Create an image
        $movie_poster = new Image();
        $movie_poster->name = 'Test name';
        $movie_poster->path = '/images/testPath';
        $movie_poster->extension = 'jpg';
        $movie_poster->description = 'The Terminator poster';
        $movie_poster->save();

        $newImageId = Image::first()->id;

        DB::table('albums')->where('id', $movie_album->id)
            ->update(['default' => $newImageId]);

        DB::table('album_image')->insert([
            'album_id' => $movie_album->id,
            'image_id' => $newImageId
        ]);

        // Put a film into the database for testing purposes. Obviously
        // it is The Terminator.
        DB::table('movies')->insert([
            'title'           => 'The Terminator',
            'country'         => 'Afghanistan',
            'release_date'    => '1984-10-26',
            'genre'           => 'Sci-Fi',
            'parental_rating' => 'G',
            'runtime'         => '100',
            'synopsis'        => 'The best terminator film ever!',
            'album'           => 1
        ]);

        $movie = Movie::first();

        // Put person into database. Person will serve as reviews and discussion creator.
        DB::table('users')->insert([
            'name'     => 'Basic Web User',
            'email'    => 'WebUser@email.com',
            'password' => 'testtest',
            'avatar'   => null
        ]);

        // Create two reviews for the newly created movie
        $review = new Review();
        $review->user_id = User::first()->id;
        $review->movie_id = $movie->id;
        $review->score = 80;
        $review->rating = 50;
        $review->title = 'This is the review title';
        $review->body = 'Here is the body of the review';
        $review->save();

        $reviewTwo = new Review();
        $reviewTwo->user_id = User::first()->id;
        $reviewTwo->movie_id = $movie->id;
        $reviewTwo->score = 60;
        $reviewTwo->rating = 90;
        $reviewTwo->title = 'This is the review title of review #2';
        $reviewTwo->body = 'Here is the body of the second review';
        $reviewTwo->save();

        // Create a discussion for the newly created movie
        $discussion = new Discussion();
        $discussion->user_id = User::first()->id;
        $discussion->movie_id = $movie->id;
        $discussion->title = 'Title of the discussion';
        $discussion->body = 'Body of the discussion';
        $discussion->save();

        $movieDiscussion = DB::table('discussions')
            ->where('movie_id', $movie->id)
            ->get();

        // Assert that there are two reviews for the movie
        $this->assertCount(2, $movie->reviews);

        // Assert that there is one discussion for the movie
        $this->assertCount(1, $movieDiscussion);

        // Assert that there is an image for the movie (image == movie poster)
        $this->assertCount(1, Album::find($movie->album)->images);

        $this->visit('admin/showAllMovies')
            ->click('delete_movie')
            ->seePageIs('admin/showAllMovies')
            ->assertSessionHas('success', 'Successfully deleted movie and all associated reviews, discussions
                            and album/images from database');

        // Assert that there is no movie, reviews, discussions, or album/images
        // in database after deletion
        $this->assertCount(0, Movie::all());
        $this->assertCount(0, Review::all());
        $this->assertCount(0, Discussion::all());
        $this->assertCount(0, Album::all());
        $this->assertCount(0, Image::all());
    }

    // Req-ID: 22
    // Test-ID: 7
    /** @test */
    public function it_can_delete_a_person_from_the_database_along_with_person_album_and_associated_person_images()
    {
        DB::table('albums')->insert([
            'id' => 1
        ]);

        $movie_album = Album::first();

        // Create an image
        $movie_poster = new Image();
        $movie_poster->name = 'Test name';
        $movie_poster->path = '/images/testPath';
        $movie_poster->extension = 'jpg';
        $movie_poster->description = 'Person Image';
        $movie_poster->save();

        $newImageId = Image::first()->id;

        DB::table('albums')->where('id', $movie_album->id)
            ->update(['default' => $newImageId]);

        DB::table('album_image')->insert([
            'album_id' => $movie_album->id,
            'image_id' => $newImageId
        ]);

        // Put a person into the database for testing purposes.
        DB::table('people')->insert([
            'first_name'        => 'Justin',
            'middle_name'       => 'Ragnar',
            'last_name'         => 'Odin',
            'first_alias'       => 'Loki',
            'middle_alias'      => 'Orpheus',
            'last_alias'        => 'Eurydice',
            'country_of_origin' => 'United States',
            'date_of_birth'     => '1995-12-22',
            'date_of_death'     => '1996-12-23',
            'biography'         => 'This is a biography',
            'album'             => 1
        ]);

        $person = Person::first();

        // Assert that there is an image for the person in the database
        $this->assertCount(1, Album::find($person->album)->images);

        $this->visit('admin/showAllPeople')
            ->click('delete_person')
            ->seePageIs('admin/showAllPeople')
            ->assertSessionHas('success', 'Successfully deleted person from database');

        // Assert that there is no person, album or image in the database after person
        // deletion
        $this->assertCount(0, Person::all());
        $this->assertCount(0, Album::all());
        $this->assertCount(0, Image::all());
    }
}
