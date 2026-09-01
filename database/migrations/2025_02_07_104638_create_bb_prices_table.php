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
            $table->bigIncrements('id');
            $table->double('price', 12, 2)->nullable();
            $table->unsignedBigInteger('price_type_id')->index('bb_prices_price_type_id_foreign');
            $table->unsignedBigInteger('bb_id')->index('bb_prices_bb_id_foreign');
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
