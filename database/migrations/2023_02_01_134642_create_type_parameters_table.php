<?php


use App\Models\TypeParameter;
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
        Schema::create('type_parameters', function (Blueprint $table) {
            $table->id();
            $table->string('type')->unique();
            $table->string('type_name')->nullable();
            $table->timestamps();
        });
        TypeParameter::updateOrCreate(['type'=>'number','type_name'=>"Число"]);
        TypeParameter::updateOrCreate(['type'=>'string','type_name'=>"Число"]);
        TypeParameter::updateOrCreate(['type'=>'boolean','type_name'=>"Да/Нет"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_parameters');
    }
};
