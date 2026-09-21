<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Колонка rubrics.icon изначально VARCHAR(255) — инлайн SVG-иконки категорий
 * не влезают (первые же иконки по 200–400 символов). Расширяем до TEXT.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('rubrics', function (Blueprint $table) {
            $table->text('icon')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('rubrics', function (Blueprint $table) {
            $table->string('icon')->nullable()->change();
        });
    }
};
