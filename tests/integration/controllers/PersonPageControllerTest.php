<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Person;
use Illuminate\Support\Facades\DB;


class PersonPageControllerTest extends TestCase
{

    use DatabaseTransactions;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

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

    // Req-ID: 9
    // Test-ID: 1
    /** @test */
    public function it_can_display_all_person_information_on_the_person_page_blade_file() {

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


    // Req-ID 154
    // Test-ID: 2
    /** @test */
    public function it_can_display_the_button_to_view_the_full_person_album () {

        $person = Person::first();
        $this->visit('people/' . $person->id)
            ->click('View All Pictures')
            ->seePageIs('album/person/' . $person->id);
    }

}