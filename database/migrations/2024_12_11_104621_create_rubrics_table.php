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
        Schema::create('rubrics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 100);
            $table->string('title_r', 100)->nullable();
            $table->string('icon')->nullable();
            $table->tinyText('description')->nullable();
            $table->unsignedBigInteger('sort')->default(500);
            $table->unsignedInteger('_lft')->default(0);
            $table->unsignedInteger('_rgt')->default(0);
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedBigInteger('level')->nullable();
            $table->timestamps();

            $table->index(['_lft', '_rgt', 'parent_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rubrics');
    }
};
