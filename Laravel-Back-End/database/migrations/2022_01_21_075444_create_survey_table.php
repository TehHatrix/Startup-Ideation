<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey', function (Blueprint $table) {
            $table->id("surveyID");
            $table->unsignedBigInteger('projectID');
            $table->foreign('projectID')->references('id')->on('projects');
            $table->string("survey_name");
            $table->integer("responses");
            $table->integer("responses_goal");
            $table->integer("total_view");
            $table->integer("today_view");
            $table->integer("remainder_view");
            $table->date('current_date');
            $table->json('series');


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
        Schema::dropIfExists('survey');
    }
}
