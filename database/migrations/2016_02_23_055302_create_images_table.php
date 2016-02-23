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
            $table->string('name')->unique();
            $table->string('path');
            $table->string('extension', 10);
            $table->timestamps();
        });

        // add the id column as a 16-bit binary field
        DB::statement('
            ALTER TABLE `images`
            ADD `id` BINARY(16) FIRST;
        ');

        // make the id column the primary key
        DB::statement('
            ALTER TABLE `images`
            ADD PRIMARY KEY (`id`);
        ');

        DB::statement('
            ALTER TABLE `users`
            ADD `avatar` BINARY(16) AFTER `password`
        ');

        Schema::table('users', function ($table) {
            $table->foreign('avatar')
                  ->references('id')->on('images')
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
