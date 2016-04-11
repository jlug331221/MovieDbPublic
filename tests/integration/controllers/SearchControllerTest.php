<?php /** Created by John on 4/10/2016 */

use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchControllerTest extends TestCase {

    use DatabaseTransactions;

    public $personObj1;
    public $movieObj1;

    public function setUp()
    {
        parent::setUp();

        $this->personObj1 = (object)array(
            'id'      => 0,
            'fn'      => 'Marion',
            'mn'      => 'Mitchell',
            'ln'      => 'Morrison',
            'fa'      => 'John',
            'ma'      => null,
            'la'      => 'Wayne',
            'dob'     => '1909-07-25',
            'dod'     => '1969-01-01',
            'imgname' => 'aEbJ13',
            'imgpath' => 'images/abcd',
            'imgext'  => 'png',
        );

        $this->movieObj1 = (object)array(
            'title'   => 'The Good, The Bad and The Ugly',
            'id'      => 0,
            'date'    => '1972-01-01',
            'imgname' => 'jEdas1',
            'imgpath' => 'images/abcd',
            'imgext'  => 'png',
        );
    }

    /** @test */
    public function it_does_a_general_suffix_search_based_on_term_that_returns_formatted_json_for_movies_and_people()
    {
        // mock the database call to return specified information
        DB::shouldReceive('table->select->distinct->join->leftJoin->join->get')
            ->withAnyArgs()
            ->twice()
            ->andReturn(
                [$this->personObj1],
                [$this->movieObj1]
            );

        $class = App::make('App\Http\Controllers\SearchController');

        $return = $class->get_suffixSearch_json('term');

        $this->assertEquals(
            [
                [
                    'id'   => 0,
                    'name' => 'The Good, The Bad and The Ugly',
                    'year' => '1972',
                    'img'  => 'images/abcd/thumbs/jEdas1.png',
                    'type' => 'm',
                ],
                [
                    'id'   => 0,
                    'name' => 'John Wayne',
                    'yob'  => '1909',
                    'yod'  => '1969',
                    'img'  => 'images/abcd/thumbs/aEbJ13.png',
                    'type' => 'p',
                ],
            ],
            $return
        );
    }

    /** @test */
    public function it_formats_names_using_the_alias_if_it_exists_for_person_results()
    {
        $this->personObj1->fa = 'John';
        $this->personObj1->ma = 'Duke';
        $this->personObj1->la = 'Wayne';

        DB::shouldReceive('table->select->distinct->join->leftJoin->join->get')
            ->withAnyArgs()
            ->twice()
            ->andReturn(
                [$this->personObj1],
                []
            );

        $class = App::make('App\Http\Controllers\SearchController');

        $return = $class->get_suffixSearch_json('term');

        $this->assertEquals(
            [
                [
                    'id'   => 0,
                    'name' => 'John Duke Wayne', // alias is John Wayne
                    'yob'  => '1909',
                    'yod'  => '1969',
                    'img'  => 'images/abcd/thumbs/aEbJ13.png',
                    'type' => 'p',
                ],
            ],
            $return
        );
    }

    /** @test */
    public function it_formats_names_using_the_first_and_last_names_if_the_alias_does_not_exist_for_person_results()
    {
        $this->personObj1->fa = null;
        $this->personObj1->ma = null;
        $this->personObj1->la = null;

        DB::shouldReceive('table->select->distinct->join->leftJoin->join->get')
            ->withAnyArgs()
            ->twice()
            ->andReturn(
                [$this->personObj1],
                []
            );

        $class = App::make('App\Http\Controllers\SearchController');

        $return = $class->get_suffixSearch_json('term');

        $this->assertEquals(
            [
                [
                    'id'   => 0,
                    'name' => 'Marion Morrison', // has no Alias, so uses first & last names (if they exist)
                    'yob'  => '1909',
                    'yod'  => '1969',
                    'img'  => 'images/abcd/thumbs/aEbJ13.png',
                    'type' => 'p',
                ],
            ],
            $return
        );
    }

    /** @test */
    public function it_returns_a_question_mark_as_the_name_if_no_suitable_name_exists()
    {
        $this->personObj1->fn = null;
        $this->personObj1->mn = null;
        $this->personObj1->ln = null;
        $this->personObj1->fa = null;
        $this->personObj1->ma = null;
        $this->personObj1->la = null;

        DB::shouldReceive('table->select->distinct->join->leftJoin->join->get')
            ->withAnyArgs()
            ->twice()
            ->andReturn(
                [$this->personObj1],
                []
            );

        $class = App::make('App\Http\Controllers\SearchController');

        $return = $class->get_suffixSearch_json('term');

        $this->assertEquals(
            [
                [
                    'id'   => 0,
                    'name' => '?', // no suitable name, so name is '?'
                    'yob'  => '1909',
                    'yod'  => '1969',
                    'img'  => 'images/abcd/thumbs/aEbJ13.png',
                    'type' => 'p',
                ],
            ],
            $return
        );
    }

    /** @test */
    public function it_has_countries_genres_and_parental_ratings_parameters_when_navigating_to_the_advanced_movie_search_page()
    {
        $this->visit('/search/movie')
            ->assertResponseOk();

        $this->assertViewHas('countries', App\Library\StaticData::$countries);
        $this->assertViewHas('genres', App\Library\StaticData::$genres);
        $this->assertViewHas('ratings', App\Library\StaticData::$ratings);
    }

    /** @test */
    public function it_has_a_countries_parameter_when_navigating_to_the_advanced_person_search_page()
    {
        $this->visit('/search/person')
            ->assertResponseOk();

        $this->assertViewHas('countries', App\Library\StaticData::$countries);
    }

    /** @test */
    public function it_returns_all_results_when_adv_movie_search_has_no_fields_checked()
    {
        $this->seedMoviesTable();

        $this->visit('/search/movie')
            ->press('Submit');

        // All movies should be shown on the page.
        $this->see('Movie Search Results')
            ->see('Drive')
            ->see('Twins')
            ->see('Rocky')
            ->see('The Hunt for Red October')
            ->see('Antman')
            ->see('The Terminator')
            ->see('Terminator 2: Judgement Day')
            ->see('Star Wars Episode IV: A New Hope')
            ->see('Star Wars Episode V: The Empire Strikes Back')
            ->see('Star Wars Episode VI: Return of the Jedi')
            ->see('The Lord of the Rings: The Fellowship of the Ring')
            ->see('The Lord of the Rings: The Two Towers')
            ->see('The Lord of the Rings: The Return of the King')
            ->see('The Martian')
            ->see('The Sword in the Stone');
    }

    /** @test */
    public function it_can_do_an_adv_movie_search_based_on_title()
    {
        $this->seedMoviesTable();

        $this->visit('/search/movie')
            ->type('The Lord of the Rings', 'name')
            ->press('Submit');

        $this->see('Movie Search Results')
            ->see('The Lord of the Rings: The Fellowship of the Ring')
            ->see('The Lord of the Rings: The Two Towers')
            ->see('The Lord of the Rings: The Return of the King')
            ->dontSee('Drive')
            ->dontSee('Twins');
    }

    /** @test */
    public function it_can_search_titles_using_partial_titles_that_begin_at_a_prefix_of_a_word_in_a_title()
    {
        $this->seedMoviesTable();

        $this->visit('/search/movie')
            ->type('Rings', 'name')
            ->press('Submit');

        $this->see('Movie Search Results')
            ->see('The Lord of the Rings: The Fellowship of the Ring')
            ->see('The Lord of the Rings: The Two Towers')
            ->see('The Lord of the Rings: The Return of the King')
            ->dontSee('Star Wars Episode VI: Return of the Jedi');

        $this->visit('/search/movie')
            ->type('Return', 'name')
            ->press('Submit');

        $this->see('Movie Search Results')
            ->dontSee('The Lord of the Rings: The Fellowship of the Ring')
            ->dontSee('The Lord of the Rings: The Two Towers')
            ->see('The Lord of the Rings: The Return of the King')
            ->see('Star Wars Episode VI: Return of the Jedi');
    }

    /** @test */
    public function it_can_do_an_advanced_movie_search_by_genre()
    {
        $this->seedMoviesTable();

        $this->visit('/search/movie');

        // using Symfony tools for ticking checkboxes because Laravel...
        $form = $this->getForm('Submit');
        $form['genre'][0]->tick(); // index associated with the 'Action' checkbox
        $this->makeRequestUsingForm($form);

        $this->see('Movie Search Results')
            ->see('Drive')
            ->see('Antman')
            ->see('The Lord of the Rings: The Fellowship of the Ring')
            ->dontSee('The Hunt for Red October')
            ->dontSee('Twins');
    }

    /** @test */
    public function it_can_include_more_than_one_genre_in_the_search()
    {
        $this->seedMoviesTable();

        $this->visit('/search/movie');

        // using Symfony tools for ticking checkboxes because Laravel...
        $form = $this->getForm('Submit');
        $form['genre'][0]->tick(); // index associated with the 'Action' checkbox
        $form['genre'][21]->tick(); // index associated with the 'Western' checkbox
        $this->makeRequestUsingForm($form);

        $this->see('Movie Search Results')
            ->see('Drive')
            ->see('Antman')
            ->see('The Lord of the Rings: The Fellowship of the Ring')
            ->see('The Hunt for Red October')
            ->dontSee('Twins');
    }

    /** @test */
    public function it_can_do_an_adv_movie_search_by_release_date_using_a_beginning_date_inclusive()
    {
        $this->seedMoviesTable();

        $this->visit('/search/movie')
            ->type('01/01/2009', 'date-start')
            ->press('Submit');

        $this->see('Movie Search Results')
            ->see('Twins')
            ->see('The Terminator')
            ->see('The Martian')
            ->see('The Sword in the Stone')
            ->dontSee('Rocky');
    }

    /** @test */
    public function it_can_do_an_adv_movie_search_by_release_date_using_an_ending_date_inclusive()
    {
        $this->seedMoviesTable();

        $this->visit('/search/movie')
            ->type('01/01/1972', 'date-end')
            ->press('Submit');

        $this->see('Movie Search Results')
            ->see('Drive')
            ->see('The Lord of the Rings: The Fellowship of the Ring')
            ->see('The Lord of the Rings: The Two Towers')
            ->dontSee('Rocky');
    }

    /** @test */
    public function it_can_do_an_adv_movie_search_by_release_date_using_a_range_inclusive()
    {
        $this->seedMoviesTable();

        $this->visit('/search/movie')
            ->type('01/01/2000', 'date-start')
            ->type('01/01/2011', 'date-end')
            ->press('Submit');

        $this->see('Movie Search Results')
            ->see('Twins')
            ->see('Terminator 2: Judgement Day')
            ->see('Star Wars Episode VI: Return of the Jedi')
            ->see('The Sword in the Stone')
            ->dontSee('Rocky');
    }

    /** @test */
    public function it_redirects_with_a_validation_error_if_the_date_is_formatted_incorrectly()
    {
        $this->seedMoviesTable();

        $this->visit('/search/movie')
            ->type('01-01-2000', 'date-start')
            ->press('Submit');

        $this->seePageIs('/search/movie')
            ->see('The date-start does not match the format m/d/Y.');
    }

    /** @test */
    public function it_redirects_with_an_error_if_the_start_date_is_after_the_end_date()
    {
        $this->seedMoviesTable();

        $this->visit('/search/movie')
            ->type('01/02/2000', 'date-start')
            ->type('01/01/2000', 'date-end')
            ->press('Submit');

        $this->seePageIs('/search/movie')
            ->see('The date-start field must be on or before the date-end field.');
    }

    /** @test */
    public function it_can_do_an_adv_movie_search_by_country()
    {
        $this->seedMoviesTable();

        $this->visit('/search/movie')
            ->select('United States', 'countries')
            ->press('Submit');

        $this->see('Movie Search Results')
            ->see('Drive')
            ->see('Twins')
            ->see('Rocky')
            ->dontSee('Antman')
            ->dontSee('The Terminator');
    }

    /** @test */
    public function it_can_search_for_movies_using_more_than_one_country()
    {
        $this->seedMoviesTable();

        $this->visit('/search/movie');

        // using Symfony tools for multiple selections because Laravel...
        $form = $this->getForm('Submit');
        $form['countries']->select(['United States', 'Brazil']);
        $this->makeRequestUsingForm($form);

        $this->see('Movie Search Results')
            ->see('Drive')
            ->see('Twins')
            ->see('Rocky')
            ->see('Antman')
            ->dontSee('The Terminator');
    }

    /** @test */
    public function it_can_do_an_adv_movie_search_by_genre()
    {
        $this->seedMoviesTable();

        $this->visit('/search/movie');

        // using Symfony tools for ticking checkboxes because Laravel...
        $form = $this->getForm('Submit');
        $form['rating'][0]->tick(); // index associated with the 'G' checkbox
        $this->makeRequestUsingForm($form);

        $this->see('Movie Search Results')
            ->see('Twins')
            ->see('Terminator 2: Judgement Day')
            ->see('Star Wars Episode VI: Return of the Jedi')
            ->see('The Sword in the Stone')
            ->dontSee('The Hunt for Red October')
            ->dontSee('The Terminator');
    }

    /** @test */
    public function it_can_search_using_more_than_one_genre()
    {
        $this->seedMoviesTable();

        $this->visit('/search/movie');

        // using Symfony tools for ticking checkboxes because Laravel...
        $form = $this->getForm('Submit');
        $form['rating'][0]->tick(); // index associated with the 'G' checkbox
        $form['rating'][4]->tick(); // index associated with the 'NC-17' checkbox
        $this->makeRequestUsingForm($form);

        $this->see('Movie Search Results')
            ->see('Twins')
            ->see('Terminator 2: Judgement Day')
            ->see('Star Wars Episode VI: Return of the Jedi')
            ->see('The Sword in the Stone')
            ->see('The Hunt for Red October')
            ->dontSee('The Terminator');
    }

    /** @test */
    public function it_can_do_an_adv_movie_search_by_runtime_using_a_minimum_value_inclusive()
    {
        $this->seedMoviesTable();

        $this->visit('/search/movie')
            ->type('121', 'runtime-min')
            ->press('Submit');

        $this->see('Movie Search Results')
            ->see('Twins')
            ->see('Rocky')
            ->see('The Lord of the Rings: The Two Towers')
            ->see('The Martian')
            ->dontSee('The Terminator');
    }

    /** @test */
    public function it_can_do_an_adv_movie_search_by_runtime_using_a_maximum_value_inclusive()
    {
        $this->seedMoviesTable();

        $this->visit('/search/movie')
            ->type('96', 'runtime-max')
            ->press('Submit');

        $this->see('Movie Search Results')
            ->see('Drive')
            ->see('Terminator 2: Judgement Day')
            ->see('The Lord of the Rings: The Return of the King')
            ->dontSee('The Martian');
    }

    /** @test */
    public function it_can_do_an_adv_movie_search_by_runtime_using_a_range_inclusive()
    {
        $this->seedMoviesTable();

        $this->visit('/search/movie')
            ->type('102', 'runtime-min')
            ->type('114', 'runtime-max')
            ->press('Submit');

        $this->see('Movie Search Results')
            ->see('The Hunt for Red October')
            ->see('Antman')
            ->see('Star Wars Episode V: The Empire Strikes Back')
            ->see('Star Wars Episode VI: Return of the Jedi')
            ->dontSee('Drive');
    }

    /** @test */
    public function it_redirects_with_a_validation_error_if_the_runtime_is_not_an_integer()
    {
        $this->seedMoviesTable();

        $this->visit('/search/movie')
            ->type('1.2', 'runtime-min')
            ->type('NAN', 'runtime-max')
            ->press('Submit');

        $this->seePageIs('/search/movie')
            ->see('The runtime-min must be an integer.')
            ->see('The runtime-max must be an integer.');
    }

    /** @test */
    public function it_redirects_with_a_validation_error_if_the_min_runtime_is_greater_than_the_max()
    {
        $this->seedMoviesTable();

        $this->visit('/search/movie')
            ->type('90', 'runtime-min')
            ->type('89', 'runtime-max')
            ->press('Submit');

        $this->seePageIs('/search/movie')
            ->see('The runtime-max field cannot be less than the runtime-min field.');
    }


    /** @test */
    public function it_takes_the_intersection_of_the_search_fields_to_give_more_specific_results()
    {
        $this->seedMoviesTable();

        $this->visit('/search/movie')
            ->type('Star Wars', 'name')
            ->type('110', 'runtime-min')
            ->press('Submit');

        $this->see('Movie Search Results')
            ->see('Star Wars Episode IV: A New Hope')
            ->dontSee('Star Wars Episode V: The Empire Strikes Back')
            ->see('Star Wars Episode VI: Return of the Jedi');
    }

    private function seedMoviesTable()
    {
        App\Movie::create(['title' => 'Drive', 'country' => 'United States', 'release_date' => '1945-01-01', 'genre' => 'Action', 'parental_rating' => 'R', 'runtime' => 90, 'synopsis' => "A mysterious Hollywood stuntman and mechanic moonlights as a getaway driver and finds himself trouble when he helps out his neighbor."]);

        App\Movie::create(['title' => 'Twins', 'country' => 'United States', 'release_date' => '2009-01-01', 'genre' => 'Comedy', 'parental_rating' => 'G', 'runtime' => 121, 'synopsis' => "A physically perfect but innocent man goes in search of his long-lost twin brother, who is a short small-time crook."]);

        App\Movie::create(['title' => 'Rocky', 'country' => 'United States', 'release_date' => '1979-01-01', 'genre' => 'Crime', 'parental_rating' => 'PG', 'runtime' => 140, 'synopsis' => "Rocky Balboa, a small-time boxer, gets a supremely rare chance to fight the heavy-weight champion, Apollo Creed, in a bout in which he strives to go the distance for his self-respect."]);

        App\Movie::create(['title' => 'The Hunt for Red October', 'country' => 'Russia', 'release_date' => '1992-01-01', 'genre' => 'Western', 'parental_rating' => 'NC-17', 'runtime' => 113, 'synopsis' => "In November 1984, the Soviet Union's best submarine captain in their newest sub violates orders and heads for the USA. Is he trying to defect or to start a war?"]);

        App\Movie::create(['title' => 'Antman', 'country' => 'Brazil', 'release_date' => '1988-01-01', 'genre' => 'Action', 'parental_rating' => 'PG-13', 'runtime' => 102, 'synopsis' => "Armed with a super-suit with the astonishing ability to shrink in scale but increase in strength, cat burglar Scott Lang must embrace his inner hero and help his mentor, Dr. Hank Pym, plan and pull off a heist that will save the world."]);

        App\Movie::create(['title' => 'The Terminator', 'country' => 'Uruguay', 'release_date' => '2013-01-01', 'genre' => 'Romance', 'parental_rating' => 'R', 'runtime' => 98, 'synopsis' => "A human-looking indestructible cyborg is sent from 2029 to 1984 to assassinate a waitress, whose unborn son will lead humanity in a war against the machines, while a soldier from that war is sent to protect her at all costs"]);

        App\Movie::create(['title' => 'Terminator 2: Judgement Day', 'country' => 'Spain', 'release_date' => '2000-01-01', 'genre' => 'Sci-Fi', 'parental_rating' => 'G', 'runtime' => 80, 'synopsis' => "A cyborg, identical to the one who failed to kill Sarah Connor, must now protect her young son, John Connor, from a more advanced cyborg, made out of liquid metal."]);

        App\Movie::create(['title' => 'Star Wars Episode IV: A New Hope', 'country' => 'France', 'release_date' => '1993-01-01', 'genre' => 'Animation', 'parental_rating' => 'PG', 'runtime' => 120, 'synopsis' => "Luke Skywalker joins forces with a Jedi Knight, a cocky pilot, a wookiee and two droids to save the galaxy from the Empire's world-destroying battle-station, while also attempting to rescue Princess Leia from the evil Darth Vader."]);

        App\Movie::create(['title' => 'Star Wars Episode V: The Empire Strikes Back', 'country' => 'Germany', 'release_date' => '1988-01-01', 'genre' => 'War', 'parental_rating' => 'R', 'runtime' => 108, 'synopsis' => "After the rebels have been brutally overpowered by the Empire on their newly established base, Luke Skywalker takes advanced Jedi training with Master Yoda, while his friends are pursued by Darth Vader as part of his plan to capture Luke."]);

        App\Movie::create(['title' => 'Star Wars Episode VI: Return of the Jedi', 'country' => 'China', 'release_date' => '2004-01-01', 'genre' => 'Crime', 'parental_rating' => 'G', 'runtime' => 114, 'synopsis' => "After rescuing Han Solo from the palace of Jabba the Hutt, the rebels attempt to destroy the second Death Star, while Luke struggles to make Vader return from the dark side of the Force."]);

        App\Movie::create(['title' => 'The Lord of the Rings: The Fellowship of the Ring', 'country' => 'Japan', 'release_date' => '1969-01-01', 'genre' => 'Action', 'parental_rating' => 'PG-13', 'runtime' => 116, 'synopsis' => "A meek Hobbit and eight companions set out on a journey to destroy the One Ring and the Dark Lord Sauron."]);

        App\Movie::create(['title' => 'The Lord of the Rings: The Two Towers', 'country' => 'Australia', 'release_date' => '1972-01-01', 'genre' => 'Biography', 'parental_rating' => 'R', 'runtime' => 128, 'synopsis' => "While Frodo and Sam edge closer to Mordor with the help of the shifty Gollum, the divided fellowship makes a stand against Sauron's new ally, Saruman, and his hordes of Isengard."]);

        App\Movie::create(['title' => 'The Lord of the Rings: The Return of the King', 'country' => 'Argentina', 'release_date' => '1999-01-01', 'genre' => 'Adventure', 'parental_rating' => 'PG-13', 'runtime' => 96, 'synopsis' => "Gandalf and Aragorn lead the World of Men against Sauron's army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring."]);

        App\Movie::create(['title' => 'The Martian', 'country' => 'Iran', 'release_date' => '2014-01-01', 'genre' => 'Horror', 'parental_rating' => 'R', 'runtime' => 130, 'synopsis' => "During a manned mission to Mars, Astronaut Mark Watney is presumed dead after a fierce storm and left behind by his crew. But Watney has survived and finds himself stranded and alone on the hostile planet. With only meager supplies, he must draw upon his ingenuity, wit and spirit to subsist and find a way to signal to Earth that he is alive."]);

        App\Movie::create(['title' => 'The Sword in the Stone', 'country' => 'Egypt', 'release_date' => '2011-01-01', 'genre' => 'Animation', 'parental_rating' => 'G', 'runtime' => 98, 'synopsis' => "The wizard Merlin teaches a young boy who is destined to be King Arthur."]);
    }
}
