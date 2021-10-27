<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LeanCanvas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LeanCanvas', function (Blueprint $table) {
            $table->id("canvas_ID");
            // $table->unsignedBigInteger('projectID');
            // $table->foreign('csID')->references('csID')->on('customer_segments');
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
        Schema::dropIfExists('LeanCanvas');
        //
    }
}
