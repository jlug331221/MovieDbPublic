<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CreditTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('credit_types')->insert([
            [
                'id'            => 1,
                'type'          => 'Director',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'id'            => 2,
                'type'          => 'Producer',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'id'            => 3,
                'type'          => 'Writer',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'id'            => 4,
                'type'          => 'Cast',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'id'            => 5,
                'type'          => 'Crew',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
