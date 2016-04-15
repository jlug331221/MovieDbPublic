<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
        $this->visit('admin/createMovie')
            ->type('The Terminator', 'title')
            ->select('United States', 'country')
            ->type('06/02/1984', 'release_date')
            ->select('Sci-Fi', 'genre')
            ->select('R', 'parental_rating')
            ->type('110', 'runtime')
            ->type('The best movie in the terminator franchise', 'synopsis')
            ->press('Create Movie')
            ->seePageIs('/admin/showAllMovies')
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
        $this->visit('admin/createPerson')
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
            ->seePageIs('/admin/showAllPeople')
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
        $this->visit('admin/createCharacter')
            ->type('Justin', 'character_name')
            ->type('Blah blah blah', 'biography')
            ->press('Create Character')
            ->seePageIs('/admin/createCharacter')
            ->assertSessionhas('success', 'Successfully added character to database!');

        // Verify that the character is in the database with all the correct
        // form information
        $this->seeInDatabase('characters', ['character_name' => 'Justin',
            'biography' => 'Blah blah blah']);
    }

}
