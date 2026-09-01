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
            $table->unsignedBigInteger('rubric_id')->index('parameter_rubric_rubric_id_foreign');
            $table->unsignedBigInteger('parameter_id')->index('parameter_rubric_parameter_id_foreign');
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
