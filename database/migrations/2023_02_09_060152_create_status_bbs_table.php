<?php

use App\Models\Status_bb;
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
            $table->id();
            $table->string('name', 50)->nullable();
            $table->text('description')->nullable();
            $table->string('active_status',3)->default('Y');
            $table->float('price',12,2)->nullable();
            $table->integer('premium_status_days')->nullable();
            $table->integer('sort')->default(500);
            $table->integer('sort_on_board')->default(500);
            $table->timestamps();
        });

        Status_bb::create(['name' => 'Стандарт']);
        Status_bb::create(['name' => 'На паузе', 'active_status'=>'N']);
        Status_bb::create(['name' => 'Удалено', 'active_status'=>'D']);
        Status_bb::create(['name' => 'Удалено безвозвратно', 'active_status'=>'DF']);
        /*Status_bb::create(['name' => 'Продано', 'active_status'=>'S']);*/
        Status_bb::create(['name' => 'Премиум 3','price'=>2.00, 'premium_status_days'=>3, 'sort_on_board' => 400]);
        Status_bb::create(['name' => 'Премиум 7','price'=>5.00, 'premium_status_days'=>7, 'sort_on_board' => 300]);
        Status_bb::create(['name' => 'Премиум 15','price'=>10.00, 'premium_status_days'=>15, 'sort_on_board' => 200]);
        Status_bb::create(['name' => 'Премиум 30','price'=>15.00, 'premium_status_days'=>30, 'sort_on_board' => 100]);
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
