<?php
/**
 * Created by PhpStorm.
 * User: JLug
 * Date: 2/14/2016
 * Time: 4:14 PM
 */

// phpunit --filter <method name> --> This will run a specific function
// instead of the whole class or directory

// php artisan migrate --database=mysql_testing --> will migrate tables
// into TestingDb instead of production database

use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase {

    use DatabaseTransactions;

    protected $user;
    protected $role;

    /**
     * Default preparation for each test
     */
    public function setUp()
    {
        parent::setUp();
    }


    // REQ-ID: 165
    // Test-ID: 1
    /** @test */
    function a_newly_created_user_does_not_have_roles() {
        $user = factory(User::class, (1))->create();
        Auth::login($user);

        $this->assertCount(0, $user->roles);
    }

    // REQ-ID: 165
    // Test-ID: 2
    /** @test */
    function attach_a_role_to_a_user_with_input_parameter_as_string() {
        $user = factory(User::class, (1))->create();
        DB::table('roles')->insert(
            ['name' => 'Administrator', 'description' => 'Super Site Admin']
        );
        $user->attachRole('Administrator');

        $this->assertEquals(true, $user->hasRole('Administrator'));
    }

    // REQ-ID: 165
    // Test-ID: 3
    /** @test */
    function detach_a_user_role_with_input_parameter_as_string() {
        $user = factory(User::class, (1))->create();
        DB::table('roles')->insert(
            ['name' => 'Review Moderator', 'description' => 'Movie Review Moderator']
        );
        $user->attachRole('Review Moderator');
        if($user->hasRole('Review Moderator')) {
            $user->detachRole('Review Moderator');
        }

        $collection = [];
        $this->assertEmpty($collection, $user->roles);
    }

    // REQ-ID: 165
    // Test-ID: 4
    /** @test */
    function attach_multiple_roles_to_a_user() {
        $user = factory(User::class, (1))->create();
        DB::table('roles')->insert(
            ['name' => 'Administrator', 'description' => 'Super Site Admin']
        );
        DB::table('roles')->insert(
            ['name' => 'Review Moderator', 'description' => 'Movie Review Moderator']
        );
        $user->attachRoles(['Administrator', 'Review Moderator']);

        $this->assertCount(2, $user->roles);
    }

    // REQ-ID: 165
    // Test-ID: 5
    /** @test */
    function detach_multiple_roles_from_a_user() {
        $user = factory(User::class, (1))->create();
        DB::table('roles')->insert(
            ['name' => 'Administrator', 'description' => 'Super Site Admin']
        );
        DB::table('roles')->insert(
            ['name' => 'Review Moderator', 'description' => 'Movie Review Moderator']
        );
        $user->attachRoles(['Administrator', 'Review Moderator']);
        if($user->hasRole(['Administrator', 'Review Moderator'])) {
            $user->detachRoles(['Administrator', 'Review Moderator']);
        }

        $collection = [];
        $this->assertEmpty($collection, $user->roles);
    }

    // REQ-ID: 107
    // Test-ID: 6
    /** @test */
    public function it_can_change_its_avatar_using_an_image()
    {
        $user = factory(User::class)->create();

        $this->assertNull($user->avatar);

        $image = factory(App\Image::class)->create();
        $user->setAvatar($image);

        $this->assertNotNull($user->avatar);
        $this->assertEquals($user->avatar, $image->id);
    }

    // REQ-ID: 107
    // Test-ID: 7
    /** @test */
    public function it_can_set_its_avatar_to_null()
    {
        $user = factory(User::class)->create();

        $this->assertNull($user->avatar);

        $image = factory(App\Image::class)->create();
        $user->setAvatar($image);

        $this->assertNotNull($user->avatar);
        $this->assertEquals($user->avatar, $image->id);

        $user->setAvatar();

        $this->assertNull($user->avatar);
    }

    // REQ-ID: 107
    // Test-ID: 8
    /** @test */
    public function it_throws_an_exception_for_invalid_parameters_when_changing_the_avatar()
    {
        $user = factory(User::class)->create();

        try {
            $user->setAvatar(42);
        } catch (\Exception $e) {
            $this->assertEquals('Could not set avatar. Invalid parameter', $e->getMessage());
            return;
        }

        $this->fail();
    }
}