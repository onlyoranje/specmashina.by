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
        Schema::create('user_files', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('bb_id')->constrained()->onDelete ('cascade');
            $table->string('url');
            $table->unsignedBigInteger('sort')->default(500);
            $table->unsignedBigInteger('size')->nullable();
            $table->string('original_name')->nullable();
            $table->string('type')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_files');
    }
};
