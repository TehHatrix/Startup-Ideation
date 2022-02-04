<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problem_statuses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('problem_id');
            $table->foreign('problem_id')->references('id')->on('problems')->onDelete('cascade');
            $table->unsignedBigInteger('lean_canvas_id');
            $table->foreign('lean_canvas_id')->references('id')->on('lean_canvases')->onDelete('cascade');
            $table->boolean('validated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problem_statuses', function(Blueprint $table) {
            $table->dropForeign('lean_canvases_lean_canvas_id_foreign');

        });
    }
}
