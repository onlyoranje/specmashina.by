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
        Schema::table('user_files', function (Blueprint $table) {
            $table->foreign(['bb_id'])->references(['id'])->on('bbs')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_files', function (Blueprint $table) {
            $table->dropForeign('user_files_bb_id_foreign');
        });
    }
};
