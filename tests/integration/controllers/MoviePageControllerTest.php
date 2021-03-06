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


class MoviePageControllerTest extends TestCase
{

    use DatabaseTransactions;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        // Needed to create an album first because of foreign key constraint
        // between a movie and an album
        DB::table('albums')->insert([
            ['id'    => 1],
            ['id'    => 2],
            ['id'    => 3]
        ]);

        // Put a film into the database for testing purposes. Obviously
        // it is random.
        DB::table('movies')->insert([
            'title'             => 'Oogie',
            'country'           => 'Myanmar',
            'release_date'      => '1910-10-10',
            'genre'             => 'Drama',
            'parental_rating'   => 'R',
            'runtime'           => '200',
            'synopsis'          => 'Oogie loves his longhorn!',
            'album'             => 1
        ]);



    }

    // Req-ID: 8
    // Test-ID: 1
    /** @test */
    public function it_can_display_all_movie_information_on_the_movie_page_blade_file() {

        $movie = Movie::first();

        $this->visit('movies/' . $movie->id)
            ->see('Oogie')
            ->see('1910')
            ->see('Myanmar')
            ->see('Drama')
            ->see('October 10, 1910')
            ->see('R')
            ->see('200')
            ->see('Oogie loves his longhorn!');
    }

//    /** @test */
//    /* Req. 144 */
//    public function it_can_display_all__movie_cast_in_cast_table(){
//
//        // Put people into the database for testing cast
//        DB::table('people')->insert([
//            [
//                'first_name'        => 'Tom',
//                'middle_name'       => 'And',
//                'last_name'         => 'Jerry',
//                'first_alias'       => 'This',
//                'middle_alias'      => 'Is',
//                'last_alias'        => 'Fake',
//                'country_of_origin' => 'United States',
//                'date_of_birth'     => '1995-12-22',
//                'date_of_death'     => '1996-12-23',
//                'biography'         => 'This is a biography',
//                'album'             => 2
//            ],
//            [
//                'first_name'        => 'Jack',
//                'middle_name'       => 'And',
//                'last_name'         => 'Jill',
//                'first_alias'       => 'Hansel',
//                'middle_alias'      => 'And',
//                'last_alias'        => 'Gretel',
//                'country_of_origin' => 'Canada',
//                'date_of_birth'     => '1995-12-25',
//                'date_of_death'     => '1996-12-25',
//                'biography'         => 'This is another biography',
//                'album'             => 3
//            ]
//        ]);
//
//        $actor1 = Person::first();
//        $actor2 = Person::all()->last();
//        $movie = Movie::first();
//
//        DB::table('characters')->insert([
//            [
//                'character_name'    => 'Justin Lugo',
//                'biography'         => 'Arnold is just awesome.'
//            ],
//
//            [
//                'character_name'    => 'Ashley Dosch',
//                'biography'         => 'Arnold is okay.'
//            ]
//        ]);
//
//        $character1 = Character::first();
//        $character2 = Character::all()->last();
//
//        DB::table('credit_types')->insert([
//            [
//                'id'       => 1,
//                'type'     => 'Director'
//            ],
//
//            [
//                'id'       => 2,
//                'type'     => 'Cast'
//            ]
//        ]);
//
//        DB::table('credits')->insert([
//            [
//                'movie_id'          => $movie->id,
//                'person_id'         => $actor1->id,
//                'credit_type_id'    => 2,
//                'character_id'      => $character1->id
//            ],
//            [
//                'movie_id'          => $movie->id,
//                'person_id'         => $actor2->id,
//                'credit_type_id'    => 2,
//                'character_id'      => $character2->id
//            ]
//        ]);
//
//        $cast = DB::table('movies')
//            ->join('credits', 'id', '=', 'movie_id')
//            ->join('people', 'person_id', '=', 'people.id')
//            ->join('albums', 'people.album', '=', 'albums.id')
//            ->join('credit_types', 'credits.credit_type_id', '=', 'credit_types.id')
//            ->leftJoin('images', 'albums.default', '=', 'images.id')
//            ->join('characters', 'character_id', '=', 'characters.id')
//            ->where('movie_id', '=', $movie->id)
//            ->where('type', '=', 'Cast')
//            ->get();
//
//        $this->visit('movies/' . $movie->id, compact($cast))
//            ->see('Oogie')
//            ->see('1910')
//            ->see('Myanmar')
//            ->see('Drama')
//            ->see('October 10, 1910')
//            ->see('R')
//            ->see('200')
//            ->see('Oogie loves his longhorn!')
//            ->press("row1")
//            ->see('Ashley Dosch')
//            ->see('Justin Lugo')
//            ->see('Tom And Jerry')
//            ->see('Jack And Jill');
//    }

    /** @test */
    /* Right now this test only works if the @can element of the movie blade is commented out */
//    public function it_can_display_an_admin_button_for_editing() {
//
//
//        DB::table('users')->insert([
//            'name'          => 'Admin User',
//            'email'         => 'Admin@email.com',
//            'password'      => bcrypt('testtest'),
//            'remember_token' => str_random(10),
//            'created_at'    =>  date("Y-m-d H:i:s"),
//            'updated_at'    =>  date("Y-m-d H:i:s"),
//            'avatar'        => null
//        ]);
//
//        $user = User::first();
//
//        DB::table('roles')->insert([
//            'name'          => 'Administrator',
//            'description'   => 'Site Super Admin',
//            'created_at'    =>  date("Y-m-d H:i:s"),
//            'updated_at'    =>  date("Y-m-d H:i:s"),
//        ]);
//
//        DB::table('permissions')->insert([
//
//            'name'          => 'edit_all_content',
//            'description'   => 'Edit Site Content',
//            'created_at'    =>  date("Y-m-d H:i:s"),
//            'updated_at'    =>  date("Y-m-d H:i:s"),
//        ]);
//
//        $adminRole = Role::first();
//        $permission = Permission::first();
//
//        DB::table('permission_role')->insert([
//            'role_id'           => $adminRole->id,
//            'permission_id'     => $permission->id,
//        ]);
//
//        DB::table('role_user')->insert([
//            'user_id'           => $user->id,
//            'role_id'           => $adminRole->id,
//        ]);
//
//
//        $movie = Movie::first();
//
//        $userAdmin = Auth::user();
//        $this->be($userAdmin);
//        $this->visit('movies/' . $movie->id)
//            ->click("adminButtonEdit");
//
//    }
//
//    /** @test */
//    /* This test doesn't work the @can implementation either */
//    public function it_can_display_an_admin_button_for_deleting() {
//        $movie = Movie::first();
//
//        $this->visit('movies/' . $movie->id)
//            ->press('Edit Movie')
//            ->seePageIs('/admin/showMovie');
//    }
//
//    public function it_can_display_the_partial_view_of_the_movie_album(){
//
//        $movie = Movie::first();
//    }

    // Req-ID: 143
    // Test-ID: 2
    /** @test */
    public function it_can_display_the_button_to_view_the_full_movie_album () {

        $movie = Movie::first();
        $this->visit('movies/' . $movie->id)
            ->click('View All Pictures')
            ->seePageIs('album/movie/' . $movie->id);
    }

}
