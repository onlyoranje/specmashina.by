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
        // Таблица могла уже существовать, если предыдущая попытка миграции
        // прервалась после create, но до записи в таблицу migrations.
        if (! Schema::hasTable('price_type_rubric')) {
            Schema::create('price_type_rubric', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('rubric_id');
                $table->unsignedBigInteger('price_type_id');
                $table->foreign('rubric_id')->references('id')->on('rubrics')->cascadeOnDelete();
                $table->foreign('price_type_id')->references('id')->on('price_types')->cascadeOnDelete();
            });
        }
        \App\Models\PriceType::firstOrCreate(['type' => 'руб']);

        // Привязываем тип цены ко всем существующим рубрикам. Раньше здесь был
        // жёсткий цикл for ($i = 1; $i < 235): миграция падала по FK на
        // rubrics.id (1452), если в базе меньше 234 рубрик — например, при
        // восстановлении БД из бэкапа или повторном прогоне.
        foreach (\App\Models\Rubric::query()->pluck('id') as $rubricId) {
            \App\Models\PriceTypeRubric::firstOrCreate(
                ['rubric_id' => $rubricId, 'price_type_id' => 1]
            );
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_type_rubric');
    }

};
