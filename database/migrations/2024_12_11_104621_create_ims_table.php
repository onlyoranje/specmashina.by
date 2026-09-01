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
        Schema::create('ims', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user1_id')->index('ims_user1_id_foreign');
            $table->unsignedBigInteger('user2_id')->index('ims_user2_id_foreign');
            $table->text('text')->nullable();
            $table->time('read_at')->nullable();
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
        Schema::dropIfExists('ims');
    }
};
