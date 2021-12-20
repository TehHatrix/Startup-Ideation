<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id('cust_ID');
            $table->unsignedBigInteger('interview_ID');
            $table->foreign('interview_ID')->references('interview_ID')->on('interview');
            $table->string('custname');
            $table->decimal('custscore',2,1)->nullable();
            $table->string('custocc');
            $table->string('cust_phone_num');
            $table->string('custemail');
            $table->text('logs')->nullable();
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
        Schema::dropIfExists('customer');
    }
}
