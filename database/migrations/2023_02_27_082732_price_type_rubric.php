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
            $table->id();

            $table->unsignedBigInteger('rubric_id');
            $table->unsignedBigInteger('price_type_id');
            $table->foreign('rubric_id')->references('id')->on('rubrics')->cascadeOnDelete();
            $table->foreign('price_type_id')->references('id')->on('price_types')->cascadeOnDelete();
        });
        \App\Models\PriceType::create(['type' => 'руб']);


        for ($i = 1; $i < 235; $i++) {
            \App\Models\PriceTypeRubric::create(['rubric_id'=>$i,'price_type_id'=>1]);
        }


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
