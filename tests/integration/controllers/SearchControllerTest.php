<?php /** Created by John on 4/10/2016 */
class SearchControllerTest extends TestCase {

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
}
