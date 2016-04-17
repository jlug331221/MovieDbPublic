<?php

use App\Character;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use App\Movie;
use App\Person;

class AdminControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function setUp() {
        parent::setUp();
    }

    // Req-ID: 17
    /** @test */
    public function it_has_a_form_to_fill_out_movie_information_to_be_inserted_into_the_database() {
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
        $this->seeInDatabase('movies', ['title' => 'The Terminator',
            'country' => 'United States', 'release_date' => '1984-06-02',
            'genre' => 'Sci-Fi', 'parental_rating' => 'R', 'runtime' => '110',
            'synopsis' => 'The best movie in the terminator franchise']);
    }

    // Req-ID: 18
    /** @test */
    public function it_has_a_form_to_fill_out_person_information_to_be_inserted_into_the_database() {
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
        $this->seeInDatabase('people', ['first_name' => 'Tommy',
            'middle_name' => 'Justin', 'last_name' => 'Yeti', 'first_alias' => 'Oprah',
            'middle_alias' => 'Dan', 'last_alias' => 'Pickle', 'country_of_origin' => 'Angola',
            'date_of_birth' => '2000-05-05', 'date_of_death' => '2000-05-06',
            'biography' => 'This person has a biography.']);
    }

    // Req-ID: 18.5
    /** @test */
    public function it_has_a_form_to_fill_out_character_information_to_be_inserted_into_the_database() {
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
            'biography' => 'Blah blah blah']);
    }

    // Req-ID: 19
    /** @test */
    public function it_can_edit_a_movie_after_information_has_been_pulled_from_the_database() {
        $errors = null;

        // Needed to create an album first because of foreign key constraint
        // between a movie and an album
        DB::table('albums')->insert([
            ['id'    => 1],
            ['id'    => 2],
            ['id'    => 3]
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
            'title'             => 'The Terminator',
            'country'           => 'Afghanistan',
            'release_date'      => '1984-10-26',
            'genre'             => 'Sci-Fi',
            'parental_rating'   => 'G',
            'runtime'           => '100',
            'synopsis'          => 'The best terminator film ever!',
            'album'             => 3
        ]);

        $movie = Movie::first();

        // Create a character
        DB::table('characters')->insert([
            'character_name'    => 'Awesome Opossum',
            'biography'         => 'Best character ever'
        ]);

        $character = Character::first();

        DB::table('credit_types')->insert([
            [
                'id'       => 1,
                'type'     => 'Director'
            ],

            [
                'id'       => 2,
                'type'     => 'Cast'
            ]
        ]);

        DB::table('credits')->insert([
            [
                'movie_id'          => $movie->id,
                'person_id'         => $actor->id,
                'credit_type_id'    => 2,
                'character_id'      => $character->id
            ],

            [
                'movie_id'          => $movie->id,
                'person_id'         => $director->id,
                'credit_type_id'    => 1,
                'character_id'      => null
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

        $this->visit('admin/showMovie/' . $movie->id, compact($cast, $crew, $errors))
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
            ->see('Director');
    }

    // Req-ID: 20
    /** @test */
    public function it_can_edit_a_person_after_information_has_been_pulled_from_the_database() {
        $errors = null;

        // Needed to create an album first because of foreign key constraint
        // between a person and an album
        DB::table('albums')->insert([
            'id'    => 1
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
        $this->visit('admin/showPerson/' . $person->id, compact($errors))
            ->see('Justin')
            ->see('Ragnar')
            ->see('Odin')
            ->see('Loki')
            ->see('Orpheus')
            ->see('Eurydice')
            ->see('United States')
            ->see('12/22/1995')
            ->see('12/23/1996')
            ->see('This is a biography');
    }
}
