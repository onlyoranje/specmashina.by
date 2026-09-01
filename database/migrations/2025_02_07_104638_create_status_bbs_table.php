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
        Schema::create('status_bbs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50)->nullable();
            $table->text('description')->nullable();
            $table->string('status', 3)->nullable();
            $table->string('active', 3)->default('Y');
            $table->double('price', 12, 2)->nullable();
            $table->integer('premium_status_days')->nullable();
            $table->integer('sort')->default(500);
            $table->integer('sort_on_board')->default(500);
            $table->string('color_bg', 7)->nullable();
            $table->string('color_badge', 7)->nullable();
            $table->string('badge_text', 25)->nullable();
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
        Schema::dropIfExists('status_bbs');
    }
};
