<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credits', function (Blueprint $table)
        {
            $table->integer('movie_id')->unsigned();
            $table->integer('person_id')->unsigned();
            $table->integer('credit_type_id')->unsigned();
            $table->integer('character_id')->unsigned()->nullable();
            $table->string('remark')->nullable();

            $table->timestamps();

            $table->primary([
                'movie_id',
                'person_id',
                'credit_type_id'
            ]);

            $table->foreign('movie_id')
                ->references('id')->on('movies')
                ->onDelete('cascade');

            $table->foreign('person_id')
                ->references('id')->on('people')
                ->onDelete('cascade');

            $table->foreign('credit_type_id')
                ->references('id')->on('credit_types')
                ->onDelete('cascade');

            $table->foreign('character_id')
                ->references('id')->on('characters')
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
        Schema::drop('credits');
    }
}
