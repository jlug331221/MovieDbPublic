<?php

/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 3/15/2016
 * Time: 11:55 AM
 */

use App\Masterlist as Masterlist;
use App\Movielist as Movielist;
use App\Personlist as Personlist;
use App\User as User;
use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ListTest extends TestCase {

    use DatabaseTransactions;
    protected $user;

    /**
     * Default preparation for each test
     */
    public function setUp()
    {
        parent::setUp();
    }
    // REQ-ID: 167
    // Test-ID: 1
    /** @test */
    function a_newly_created_user_does_not_have_any_lists() {
        $user = factory(User::class, (1))->create();
        Auth::login($user);

        $this->assertCount(0, $user->masterlists);
    }
    // REQ-ID: 26
    // Test-ID: 2
    /** @test */
    function an_existing_user_can_create_masterlist() {
        $user = factory(User::class, (1))->create();
        Auth::login($user);

        $masterlist = new Masterlist();
        $masterlist->user_id = $user->id;
        $masterlist->title = "Masterlist";
        $masterlist->type = "M";
        $masterlist->save();

        $this->assertCount(1, $user->masterlists);
    }
    // REQ-ID: 64
    // Test-ID: 3
    /** @test */
    function an_existing_user_can_delete_masterlist() {
        $user = factory(User::class, (1))->create();
        Auth::login($user);

        $masterlist = new Masterlist();
        $masterlist->user_id = $user->id;
        $masterlist->title = "Masterlist";
        $masterlist->type = "M";
        $masterlist->save();

        Masterlist::destroy($masterlist->id);

        $this->assertCount(0, $user->masterlists);
    }



    public function tearDown()
    {
        parent::tearDown();
    }


}
