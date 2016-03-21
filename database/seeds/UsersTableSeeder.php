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
                'created_at'    =>  date("Y-m-d H:i:s"),
                'updated_at'    =>  date("Y-m-d H:i:s"),
                'avatar'        => null
            ],

            [
                'name'          => 'Movie Review Moderator',
                'email'         => 'MovieReviewerMod@email.com',
                'password'      => bcrypt('testtest'),
                'remember_token' => str_random(10),
                'created_at'    =>  date("Y-m-d H:i:s"),
                'updated_at'    =>  date("Y-m-d H:i:s"),
                'avatar'        => null
            ],

            [
                'name'          => 'Basic Web User',
                'email'         => 'WebUser@email.com',
                'password'      => bcrypt('testtest'),
                'remember_token' => str_random(10),
                'created_at'    =>  date("Y-m-d H:i:s"),
                'updated_at'    =>  date("Y-m-d H:i:s"),
                'avatar'        => null
            ],
        ]);
    }
}
