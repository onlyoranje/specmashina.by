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
        Schema::table('bb_reject_reasons', function (Blueprint $table) {
            $table->foreign(['bb_id'])->references(['id'])->on('bbs')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['reason_id'])->references(['id'])->on('bb_reject_reasons')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bb_reject_reasons', function (Blueprint $table) {
            $table->dropForeign('bb_reject_reasons_bb_id_foreign');
            $table->dropForeign('bb_reject_reasons_reason_id_foreign');
        });
    }
};
