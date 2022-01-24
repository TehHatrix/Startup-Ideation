<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEarlyadopterslandingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('earlyadopterslanding', function (Blueprint $table) {
            $table->id('adopter_ID');
            $table->unsignedBigInteger('landingpageID');
            $table->foreign('landingpageID')->references('landingpageID')->on('landing_pages');
            $table->string('adoptername');
            $table->string('adopteremail');
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
        Schema::dropIfExists('earlyadopterslanding');
    }
}
