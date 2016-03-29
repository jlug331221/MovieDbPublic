<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovieListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('masterlist_id')->unsigned();

            $table->timestamps();

            $table->foreign('masterlist_id')
                ->references('id')->on('masterlists')
                ->onDelete('cascade');
        });

        Schema::create('movie_movie_list' , function(Blueprint $table) {
            $table->integer('movie_id')->unsigned();
            $table->integer('movie_list_id')->unsigned();

            $table->primary(['movie_id', 'movie_list_id']);

            $table->foreign('movie_id')
                ->references('id')
                ->on('movies')
                ->onDelete('cascade');

            $table->foreign('movie_list_id')
                ->references('id')
                ->on('movie_lists')
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
        Schema::drop('movie_movie_list');
        Schema::drop('movie_lists');
    }
}
