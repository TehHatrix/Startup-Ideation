<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_answer', function (Blueprint $table) {
        $table->id('userAnswerID');
        $table->unsignedBigInteger('surveyID');
        $table->foreign('surveyID')->references('surveyID')->on('survey')->onDelete('cascade');
        $table->string('discover');
        $table->string('dissapointed');
        $table->string('reasonDissapoint');
        $table->string('alternative');
        $table->string('benefits');
        $table->string('recommendAny');
        $table->string('personBenefit');
        $table->string('improveSuggest');
        $table->string('contacts');
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
        Schema::dropIfExists('user_answer');
    }
}
