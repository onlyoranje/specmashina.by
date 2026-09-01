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
        Schema::create('bb_parameters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parameter_id');
            $table->unsignedBigInteger('bb_id')->index('bb_parameters_bb_id_foreign');
            $table->string('value')->nullable();
            $table->timestamps();

            $table->unique(['parameter_id', 'bb_id'], 'parameter_bb');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bb_parameters');
    }
};
