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
            $table->id();
            $table->string('title',100);
            $table->tinyText('description')->nullable();
            //$table->unsignedBigInteger('parent_id')->nullable();
            //$table->foreign('parent_id')->references('id')->on('rubrics')->onDelete('restrict');
            $table->unsignedBigInteger('sort')->default(500);
            $table->nestedSet();
            $table->unsignedBigInteger('level')->nullable();
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
        Schema::dropIfExists('rubrics');
    }
};
