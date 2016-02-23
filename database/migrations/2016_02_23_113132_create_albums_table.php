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
            $table->timestamps();
        });

        // create the album_image pivot table
        Schema::create('album_image', function (Blueprint $table) {
            $table->integer('album_id')->unsigned();
        });

        // add the image_id column as a 16-bit binary field in the album_image pivot table
        DB::statement('ALTER TABLE `album_image` ADD `image_id` BINARY(16) AFTER `album_id`;');

        // set the primary keys and foreign keys for the album_image pivot table
        Schema::table('album_image', function ($table) {
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
