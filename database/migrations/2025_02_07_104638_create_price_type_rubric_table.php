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
        Schema::create('price_type_rubric', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('rubric_id')->index('price_type_rubric_rubric_id_foreign');
            $table->unsignedBigInteger('price_type_id')->index('price_type_rubric_price_type_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_type_rubric');
    }
};
