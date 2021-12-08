<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomerProblem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CustomerProblem', function (Blueprint $table) {
            $table->id("CustomerProblem_ID");
            $table->unsignedBigInteger('cs_ID');
            $table->foreign('cs_ID')->references('id')->on('customer_segments');
            $table->unsignedBigInteger('problem_ID');
            $table->foreign('problem_ID')->references('id')->on('problems');
            $table->timestamps();

        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CustomerProblem');
        //
    }
}
