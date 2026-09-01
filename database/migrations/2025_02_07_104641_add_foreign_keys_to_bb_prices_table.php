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
        Schema::table('bb_prices', function (Blueprint $table) {
            $table->foreign(['bb_id'])->references(['id'])->on('bbs')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['price_type_id'])->references(['id'])->on('price_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bb_prices', function (Blueprint $table) {
            $table->dropForeign('bb_prices_bb_id_foreign');
            $table->dropForeign('bb_prices_price_type_id_foreign');
        });
    }
};
