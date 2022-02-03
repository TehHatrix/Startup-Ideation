<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview', function (Blueprint $table) {
            $table->id('interview_ID');
            $table->unsignedBigInteger('hypothesis_ID');
            $table->foreign('hypothesis_ID')->references('hypothesis_ID')->on('hypotheses')->onDelete('cascade');
            $table->text('script')->nullable();
            $table->string('objective');
            $table->integer('goal');
            $table->decimal('overall_score',2,1);
            $table->integer('progress');
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
        Schema::dropIfExists('interview');
    }
}
