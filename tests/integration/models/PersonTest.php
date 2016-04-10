<?php /** Created by John on 4/9/2016 */

use App\Person;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PersonTest extends TestCase {

    use DatabaseTransactions;

    /**
     * Default preparation for each test
     */
    public function setUp()
    {
        parent::setUp();
    }

    /** @test */
    public function it_has_a_best_name_which_is_the_persons_alias_if_one_exists()
    {
        $person = new Person();
        $person->first_name = 'Marion';
        $person->middle_name = 'Mitchell';
        $person->last_name = 'Morrison';
        $person->first_alias = 'John';

        $this->assertEquals('John', $person->getBestName());

        $person->last_alias = 'Wayne';

        $this->assertEquals('John Wayne', $person->getBestName());

        $person->middle_alias = 'Duke';

        $this->assertEquals('John Duke Wayne', $person->getBestName());

        $person->last_alias = null;

        $this->assertEquals('John Duke', $person->getBestName());

        $person->first_alias = null;

        $this->assertEquals('Marion Morrison', $person->getBestName());
    }


    /** @test */
    public function it_has_a_best_name_which_is_the_persons_actual_name_if_no_alias_exists()
    {
        $person = new Person();
        $person->first_name = 'Marion';
        $person->middle_name = 'Mitchell';

        $this->assertEquals('Marion', $person->getBestName());

        $person->last_name = 'Morrison';

        $this->assertEquals('Marion Morrison', $person->getBestName());

        $person->first_name = null;

        $this->assertEquals('Morrison', $person->getBestName());
    }

    /** @test */
    public function it_has_a_best_name_which_is_question_mark_if_no_best_name_exists()
    {
        $person = new Person();

        $this->assertEquals('?', $person->getBestName());

        $person->middle_name = 'Mitchell';

        $this->assertEquals('?', $person->getBestName());

        $person->middle_alias = 'Duke';

        $this->assertEquals('?', $person->getBestName());

        $person->last_alias = 'Wayne';

        $this->assertEquals('?', $person->getBestName());
    }

    /** @test */
    public function it_can_get_the_birth_year_of_a_person()
    {
        $person = new Person();
        $person->date_of_birth = '1972-01-01';

        $this->assertEquals('1972', $person->getBirthAndDeathYears());
    }

    /** @test */
    public function it_can_get_the_birth_and_death_year_of_a_person()
    {
        $person = new Person();
        $person->date_of_birth = '1941-02-33';
        $person->date_of_death = '1996-04-15';

        $this->assertEquals('1941 - 1996', $person->getBirthAndDeathYears());
    }

    /** @test */
    public function it_returns_a_question_mark_if_the_person_has_no_birth_year()
    {
        $person = new Person();

        $this->assertEquals('?', $person->getBirthAndDeathYears());

        $person->date_of_death = '1996-04-15';

        $this->assertEquals('?', $person->getBirthAndDeathYears());
    }

    /** @test */
    public function it_creates_an_associated_album_whenever_a_person_is_created()
    {
        $person = new Person();
        $person->first_name = 'John';
        $person->last_name = 'Wayne';
        $person->country_of_origin = 'United States';
        $person->date_of_birth = '1909-07-25';
        $person->save();

        $album = $person->album()->firstOrFail();

        $this->assertNotNull($person->album);
        $this->assertNotNull($album);
        $this->assertEquals($person->album, $album->id);
    }

    /** @test */
    public function it_stores_all_suffixes_of_a_persons_names_when_a_person_is_created()
    {
        $person = new Person();
        $person->first_name = 'Al';
        $person->middle_name = 'Ted';
        $person->last_name = 'Lin';
        $person->first_alias = 'Ty';
        $person->middle_alias = 'Bo';
        $person->last_alias = 'Rae';
        $person->country_of_origin = 'United States';
        $person->date_of_birth = '1909-07-25';
        $person->save();

        $id = $person->id;

        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'Al')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'l')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'Ted')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'ed')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'd')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'Lin')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'in')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'n')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'Ty')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'y')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'Bo')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'o')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'Rae')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'ae')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'e')->first();
        $this->assertEquals($id, $r->person_id);
    }

    /** @test */
    public function it_updates_all_suffixes_of_a_persons_names_when_a_person_is_updated()
    {
        $person = new Person();
        $person->first_name = 'Bo';
        $person->last_name = 'Jun';
        $person->country_of_origin = 'United States';
        $person->date_of_birth = '1909-07-25';
        $person->save();

        $id = $person->id;

        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'Bo')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'o')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'Jun')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'un')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'n')->first();
        $this->assertEquals($id, $r->person_id);

        $person->first_name = 'Re';
        $person->last_name = 'Pa';
        $person->save();

        $this->assertNull(DB::table('person_suffixes')->where('name_suffix', '=', 'Bo')->first());
        $this->assertNull(DB::table('person_suffixes')->where('name_suffix', '=', 'o')->first());
        $this->assertNull(DB::table('person_suffixes')->where('name_suffix', '=', 'Jun')->first());
        $this->assertNull(DB::table('person_suffixes')->where('name_suffix', '=', 'un')->first());
        $this->assertNull(DB::table('person_suffixes')->where('name_suffix', '=', 'n')->first());

        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'Re')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'e')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'Pa')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'a')->first();
        $this->assertEquals($id, $r->person_id);
    }

    /** @test */
    public function it_removes_all_suffixes_of_a_persons_name_when_the_person_is_delete()
    {
        $person = new Person();
        $person->first_name = 'Bo';
        $person->last_name = 'Jun';
        $person->country_of_origin = 'United States';
        $person->date_of_birth = '1909-07-25';
        $person->save();

        $id = $person->id;

        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'Bo')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'o')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'Jun')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'un')->first();
        $this->assertEquals($id, $r->person_id);
        $r = DB::table('person_suffixes')->where('name_suffix', '=', 'n')->first();
        $this->assertEquals($id, $r->person_id);

        $person->delete();

        $this->assertNull(DB::table('person_suffixes')->where('name_suffix', '=', 'Bo')->first());
        $this->assertNull(DB::table('person_suffixes')->where('name_suffix', '=', 'o')->first());
        $this->assertNull(DB::table('person_suffixes')->where('name_suffix', '=', 'Jun')->first());
        $this->assertNull(DB::table('person_suffixes')->where('name_suffix', '=', 'un')->first());
        $this->assertNull(DB::table('person_suffixes')->where('name_suffix', '=', 'n')->first());
    }
}
