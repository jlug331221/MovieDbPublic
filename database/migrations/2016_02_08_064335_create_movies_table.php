<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->string('country');
            $table->date('release_date');
            $table->string('genre');
            $table->string('parental_rating')->nullable();
            $table->integer('runtime');
            $table->text('synopsis')->nullable();
            $table->text('title_alphanumeric');
            $table->text('synopsis_alphanumeric')->nullable();

            $table->timestamps();

            $table->index('title');
        });

        DB::statement("CREATE FULLTEXT INDEX fulltext_index ON movies(title_alphanumeric, synopsis_alphanumeric)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('movies');
    }
}
