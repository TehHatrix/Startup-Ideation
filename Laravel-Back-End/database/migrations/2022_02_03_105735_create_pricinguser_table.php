<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricinguserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricinguser', function (Blueprint $table) {
            $table->id('pricinguserID');
            $table->unsignedBigInteger('landingpageID');
            $table->foreign('landingpageID')->references('landingpageID')->on('landing_pages')->onDelete('cascade');
            $table->string('username');
            $table->string('useremail');
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
        Schema::dropIfExists('pricinguser');
    }
}
