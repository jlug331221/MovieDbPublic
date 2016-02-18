<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'name'          => 'edit_all_content',
                'description'   => 'Edit Site Content',
                'created_at'    =>  date("Y-m-d H:i:s"),
                'updated_at'    =>  date("Y-m-d H:i:s"),
            ],

            [
                'name'          => 'edit_movie_reviews',
                'description'   => 'Edit Movie Reviews',
                'created_at'    =>  date("Y-m-d H:i:s"),
                'updated_at'    =>  date("Y-m-d H:i:s"),
            ],

            [
                'name'          => 'edit_movie_comments',
                'description'   => 'Edit Movie Comments',
                'created_at'    =>  date("Y-m-d H:i:s"),
                'updated_at'    =>  date("Y-m-d H:i:s"),
            ],
        ]);
    }
}
