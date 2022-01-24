<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id("landingpageID");
            $table->unsignedBigInteger('projectID');
            $table->foreign('projectID')->references('id')->on('projects');
            $table->integer('sign_ups');
            $table->integer('unique_view');
            $table->integer('expected_revenue');
            $table->integer('target_revenue');
            $table->longText('landingHTML');
            $table->longText('landingCSS');
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
        Schema::dropIfExists('landing_pages');
    }
}
