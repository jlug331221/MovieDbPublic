<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'          => 'Admin User',
                'email'         => 'Admin@email.com',
                'password'      => bcrypt('testtest'),
                'remember_token' => str_random(10),
            ],

            [
                'name'          => 'Movie Review Moderator',
                'email'         => 'MovieReviewerMod@email.com',
                'password'      => bcrypt('testtest'),
                'remember_token' => str_random(10),
            ],

            [
                'name'          => 'Basic Web User',
                'email'         => 'WebUser@email.com',
                'password'      => bcrypt('testtest'),
                'remember_token' => str_random(10),
            ],
        ]);
    }
}
