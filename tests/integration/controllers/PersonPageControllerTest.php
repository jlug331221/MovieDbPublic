<?php
//Created by Ashley

use App\Character;
use App\Permission;
use App\Person;
use App\Role;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Movie;

class PersonPageControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function setUp()
    {
        // Needed to create an album first because of foreign key constraint
        // between a person and an album
        DB::table('albums')->insert([
            'id'    => 1
        ]);

        // Put a person into the database for testing purposes.
        DB::table('people')->insert([
            'first_name'        => 'Tom',
            'middle_name'       => 'and',
            'last_name'         => 'Jerry',
            'first_alias'       => 'Jack',
            'middle_alias'      => 'and',
            'last_alias'        => 'Jill',
            'country_of_origin' => 'United States',
            'date_of_birth'     => '1995-12-22',
            'date_of_death'     => '1996-12-23',
            'biography'         => 'This is a biography',
            'album'             => 1
        ]);
    }

    /** @test */
    /* Req. 9 */
    public function it_can_display_all_movie_information_on_the_movie_page_blade_file() {

        $person = Person::first();
        $this->visit('people/' . $person->id)
            ->see('Tom')
            ->see('and')
            ->see('Jerry')
            ->see('Jack')
            ->see('and')
            ->see('Jill')
            ->see('United States')
            ->see('December 22, 1995')
            ->see('December 23, 1996')
            ->see('This is a biography');
    }


    /** @test */
    /* Req. 154 */
    public function it_can_display_the_button_to_view_the_full_movie_album () {

        $person = Person::first();
        $this->visit('people/' . $person->id)
            ->click('View All Pictures')
            ->seePageIs('album/person/' . $person->id);
    }
}
