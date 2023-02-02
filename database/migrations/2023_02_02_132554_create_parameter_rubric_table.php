<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameter_rubric', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('rubric_id');
            $table->unsignedBigInteger('parameter_id');
            $table->foreign('rubric_id')->references('id')->on('rubrics');
            $table->foreign('parameter_id')->references('id')->on('parameters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parameter_rubric');
    }
};
