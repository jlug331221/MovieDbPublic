<?php
/**
 * Created by PhpStorm.
 * User: JLug
 * Date: 2/14/2016
 * Time: 4:14 PM
 */

// phpunit --filter <method name> --> This will run a specific function
// instead of the whole class or directory

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

    /** @test */
    function a_newly_created_user_does_not_have_roles() {
        $user = factory(User::class, (1))->create();
        Auth::login($user);

        $this->assertCount(0, $user->getRoles());
    }

    /** @test */
    function attach_a_role_to_a_user_with_input_parameter_as_string() {
        $user = factory(User::class, (1))->create();
        $user->attachRole('Administrator');

        $this->assertEquals(true, $user->hasRole('Administrator'));
    }

    /** @test */
    function detach_a_user_role_with_input_parameter_as_string() {
        $user = factory(User::class, (1))->create();
        $user->attachRole('Review Moderator');
        if($user->hasRole('Review Moderator')) {
            $user->detachRole('Review Moderator');
        }

        $collection = [];
        $this->assertEmpty($collection, $user->getRoles());
    }

    /** @test */
    function attach_multiple_roles_to_a_user() {
        $user = factory(User::class, (1))->create();
        $user->attachRoles(['Administrator', 'Review Moderator']);

        $this->assertCount(2, $user->getRoles());
    }

    /** @test */
    function detach_multiple_roles_from_a_user() {
        $user = factory(User::class, (1))->create();
        $user->attachRoles(['Administrator', 'Review Moderator']);
        if($user->hasRole(['Administrator', 'Review Moderator'])) {
            $user->detachRoles(['Administrator', 'Review Moderator']);
        }

        $collection = [];
        $this->assertEmpty($collection, $user->getRoles());
    }

    public function tearDown()
    {
        parent::tearDown();
    }
}