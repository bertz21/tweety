<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('tweet_id')->constrained()->onDelete('cascade');
            $table->boolean('liked'); // 0 means dislike, 1 means likes
            $table->timestamps();

            //  ->constrained() is foreign key method in laravel version 7
            // and it is equal to code like this below
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


            // only one record of like and must be unique
            $table->unique(['user_id', 'tweet_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
