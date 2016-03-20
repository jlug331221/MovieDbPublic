<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('default')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('default')
                ->references('id')
                ->on('images')
                ->onDelete('set null');
        });

        // create the album_image pivot table
        Schema::create('album_image', function (Blueprint $table) {
            $table->integer('album_id')->unsigned();
            $table->integer('image_id')->unsigned();

            $table->primary([
                'album_id',
                'image_id'
            ]);

            $table->foreign('album_id')
                ->references('id')
                ->on('albums')
                ->onDelete('cascade');

            $table->foreign('image_id')
                ->references('id')
                ->on('images')
                ->onDelete('cascade');
        });

        // make the album column in the movies table a foreign key referencing id in albums
        Schema::table('movies', function ($table) {
            $table->integer('album')->unsigned();

            $table->foreign('album')
                ->references('id')
                ->on('albums')
                ->onDelete('cascade');
        });

        // make the album column in the people table a foreign key referencing id in albums
        Schema::table('people', function ($table) {
            $table->integer('album')->unsigned();

            $table->foreign('album')
                ->references('id')
                ->on('albums')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('album_image');
        Schema::drop('albums');
    }
}
