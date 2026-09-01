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
        Schema::table('parameter_rubric', function (Blueprint $table) {
            $table->foreign(['parameter_id'])->references(['id'])->on('parameters')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['rubric_id'])->references(['id'])->on('rubrics')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parameter_rubric', function (Blueprint $table) {
            $table->dropForeign('parameter_rubric_parameter_id_foreign');
            $table->dropForeign('parameter_rubric_rubric_id_foreign');
        });
    }
};
