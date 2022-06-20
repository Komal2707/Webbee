<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaSchema extends Migration
{
    /**
    # Create a migration that creates all tables for the following user stories

    For an example on how a UI for an api using this might look like, please try to book a show at https://in.bookmyshow.com/.
    To not introduce additional complexity, please consider only one cinema.

    Please list the tables that you would create including keys, foreign keys and attributes that are required by the user stories.

    ## User Stories

     **Movie exploration**
     * As a user I want to see which films can be watched and at what times
     * As a user I want to only see the shows which are not booked out

     **Show administration**
     * As a cinema owner I want to run different films at different times
     * As a cinema owner I want to run multiple films at the same time in different locations

     **Pricing**
     * As a cinema owner I want to get paid differently per show
     * As a cinema owner I want to give different seat types a percentage premium, for example 50 % more for vip seat

     **Seating**
     * As a user I want to book a seat
     * As a user I want to book a vip seat/couple seat/super vip/whatever
     * As a user I want to see which seats are still available
     * As a user I want to know where I'm sitting on my ticket
     * As a cinema owner I dont want to configure the seating for every show
     */
    public function up()
    {
        // throw new \Exception('implement in coding task 4, you can ignore this exception if you are just running the initial migrations.');
        Schema::create('movies', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        
        Schema::create('shows', function($table) {
            $table->increments('id');
            $table->integer('movie_id')->unsigned()->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('location');
            $table->string('booking_status');
            $table->timestamps();
        });

        Schema::create('prices', function($table) {
            $table->increments('id');
            $table->integer('show_id')->unsigned()->foreign('show_id')->references('id')->on('shows')->onDelete('cascade');
            $table->integer('premium_price_id')->unsigned()->foreign('premium_price_id')->references('id')->on('premium_prices')->onDelete('cascade');
            $table->string('amount');
            $table->timestamps();
        });

        Schema::create('premium_prices', function($table) {
            $table->increments('id');
            $table->integer('seat_type_id')->unsigned()->foreign('seat_type_id')->references('id')->on('seat_types')->onDelete('cascade');
            $table->string('percentage_premium');
            $table->timestamps();
        });

        Schema::create('seat_types', function($table) {
            $table->increments('id');
            $table->string('type');
            $table->timestamps();
        });

        Schema::create('seats', function($table) {
            $table->increments('id');
            $table->integer('show_id')->unsigned()->foreign('show_id')->references('id')->on('shows')->onDelete('cascade');
            $table->integer('seat_type_id')->unsigned()->foreign('seat_type_id')->references('id')->on('seat_types')->onDelete('cascade');
            $table->string('seat');
            $table->string('seat_status');
            $table->string('seat_position');
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
    }
}
