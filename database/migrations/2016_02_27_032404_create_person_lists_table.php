<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('masterlist_id')->unsigned();

            $table->timestamps();

            $table->foreign('masterlist_id')
                ->references('id')->on('masterlists')
                ->onDelete('cascade');
        });

        Schema::create('person_person_list' , function(Blueprint $table) {
            $table->integer('person_id')->unsigned();
            $table->integer('person_list_id')->unsigned();

            $table->primary(['person_id', 'person_list_id']);

            $table->foreign('person_id')
                ->references('id')
                ->on('people')
                ->onDelete('cascade');

            $table->foreign('person_list_id')
                ->references('id')
                ->on('person_lists')
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
        Schema::drop('person_person_list');
        Schema::drop('person_lists');
    }
}
