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
        Schema::table('credits_logs', function (Blueprint $table) {
            $table->foreign(['bb_id'])->references(['id'])->on('bbs')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('credits_logs', function (Blueprint $table) {
            $table->dropForeign('credits_logs_bb_id_foreign');
            $table->dropForeign('credits_logs_user_id_foreign');
        });
    }
};
