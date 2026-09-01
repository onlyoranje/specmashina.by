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
        Schema::table('post_statistics', function (Blueprint $table) {
            $table->foreign(['post_id'])->references(['id'])->on('posts')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_statistics', function (Blueprint $table) {
            $table->dropForeign('post_statistics_post_id_foreign');
        });
    }
};
