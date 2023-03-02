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
            $table->float('price',12,2)->nullable();
            $table->unsignedBigInteger('price_type_id');
            $table->foreign('price_type_id')->references('id')->on('price_types');
            $table->foreignId('bb_id')->constrained()->onDelete('cascade');
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
