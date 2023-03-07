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
        Schema::create('contact_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->string('mask')->nullable();
            $table->string('icon')->nullable();
            $table->bigInteger('sort')->default(500);
            $table->string('required')->nullable();
            $table->timestamps();
        });
        \App\Models\ContactType::create(['name' => 'Телефон','mask'=>'+375 99 999-99-99']);
        \App\Models\ContactType::create(['name' => 'Viber']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_types');
    }
};
