<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerSegmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_segments', function (Blueprint $table) {
            $table->id("cs_ID");
            $table->unsignedBigInteger('canvas_ID');
            $table->foreign('canvas_ID')->references('canvas_ID')->on('LeanCanvas')->nullable();
            $table->string("topic");
            $table->string("description");
            $table->string('publisher');
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
        Schema::dropIfExists('customer_segments');
    }
}
