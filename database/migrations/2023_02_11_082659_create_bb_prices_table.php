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
        Schema::create('bb_prices', function (Blueprint $table) {
            $table->id();
            $table->float('price',12,2);
            $table->unsignedBigInteger('price_type_id');
            $table->foreign('price_type_id')->references('id')->on('price_types');
            $table->unsignedBigInteger('bb_id');
            $table->foreign('bb_id')->references('id')->on('bbs');
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
        Schema::dropIfExists('bb_prices');
    }
};
