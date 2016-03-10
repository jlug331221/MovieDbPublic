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
