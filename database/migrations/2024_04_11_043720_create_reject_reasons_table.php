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
        Schema::create('reject_reasons', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('reason')->nullable();
        });
        \App\Models\RejectReasons::create(['reason'=>'Некорректный заголовок']);
        \App\Models\RejectReasons::create(['reason'=>'Некорректное описание']);
        \App\Models\RejectReasons::create(['reason'=>'Некорректное изображение']);
        \App\Models\RejectReasons::create(['reason'=>'Некорректные харктеристики']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reject_reasons');
    }
};
