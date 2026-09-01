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
        Schema::table('price_type_rubric', function (Blueprint $table) {
            $table->foreign(['price_type_id'])->references(['id'])->on('price_types')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['rubric_id'])->references(['id'])->on('rubrics')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('price_type_rubric', function (Blueprint $table) {
            $table->dropForeign('price_type_rubric_price_type_id_foreign');
            $table->dropForeign('price_type_rubric_rubric_id_foreign');
        });
    }
};
