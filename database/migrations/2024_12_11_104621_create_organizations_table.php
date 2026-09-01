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
        Schema::create('organizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->unsignedBigInteger('location_id')->index('organizations_location_id_foreign');
            $table->string('address');
            $table->string('unp');
            $table->string('site')->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->string('phone')->nullable();
            $table->text('content')->nullable();
            $table->string('active')->default('Y');
            $table->string('approve')->default('N');
            $table->unsignedBigInteger('user_id')->index('organizations_user_id_foreign');
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
        Schema::dropIfExists('organizations');
    }
};
