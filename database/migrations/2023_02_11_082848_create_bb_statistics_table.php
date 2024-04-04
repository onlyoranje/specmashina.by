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
        Schema::create('bb_statistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bb_id');
            $table->foreign('bb_id')->references('id')->on('bbs')->constrained()->onDelete('cascade');
            $table->string('user_token')->nullable();
            $table->integer("views")->default(1);
            $table->timestamps();
            $table->unique(['user_token', 'bb_id'],'user_bb');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bb_statistics');
    }
};
