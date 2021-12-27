<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreeCanvasContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free_canvas_contents', function (Blueprint $table) {
            $table->id();
            $table->longText('content');
            $table->integer('publisher_id');
            $table->unsignedBigInteger('free_canvas_id');
            $table->foreign('free_canvas_id')->references('id')->on('free_canvases');
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
        Schema::dropIfExists('free_canvas_contents', function (Blueprint $table) {
            $table->dropForeign('free_canvases_free_canvas_id_foreign');
        });
        // Schema::dropIfExists('free_canvas_contents');
    }
}
