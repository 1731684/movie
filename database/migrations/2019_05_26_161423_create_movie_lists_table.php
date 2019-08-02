<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

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
            $table->string('movie_name');
            $table->string('language')->nullable();
            $table->integer('theater_id')->unsigned();
            $table->foreign('theater_id')->references('id')->on('theaters')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('city_lists')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('time',['7.00AM','10.00AM','1.00PM','4.00PM','7.00PM']);
            $table->date('date_from');
            $table->date('date_to');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_lists');
    }
}
