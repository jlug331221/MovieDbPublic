<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('path');
            $table->string('extension', 10);
            $table->string('description', 256)->nullable();
            $table->timestamps();
        });

        // make the avatar column in the users table a foreign key referencing id in images
        Schema::table('users', function ($table) {
            $table->integer('avatar')->unsigned()->nullable();

            $table->foreign('avatar')
                ->references('id')
                ->on('images')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('images');
    }
}
