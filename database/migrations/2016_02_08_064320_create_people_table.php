<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');

            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('first_alias')->nullable();
            $table->string('middle_alias')->nullable();
            $table->string('last_alias')->nullable();
            $table->string('country_of_origin');
            $table->date('date_of_birth');
            $table->date('date_of_death')->nullable();
            $table->text('biography')->nullable();
            /* $table->integer('album_id')->unsigned(); Foreign key for image album */

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('people');
    }
}
