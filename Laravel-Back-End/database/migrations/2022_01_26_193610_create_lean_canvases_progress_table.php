<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeanCanvasesProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lean_canvases_progress', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('customer_segment');
            $table->boolean('problem');
            $table->boolean('revenue');
            $table->boolean('solution');
            $table->boolean('unique_value_proposition');
            $table->boolean('channel');
            $table->boolean('key_metric');
            $table->boolean('cost_structure');
            $table->boolean('unfair_advantage');
            $table->unsignedBigInteger('lean_canvas_id');
            $table->foreign('lean_canvas_id')->references('id')->on('lean_canvases')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lean_canvases_progress', function(Blueprint $table) {
            $table->dropForeign('lean_canvases_lean_canvas_id_foreign');
        });
    }
}
