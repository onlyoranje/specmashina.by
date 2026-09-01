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
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('active')->default('Y');
            $table->string('title');
            $table->text('preview_text')->nullable();
            $table->text('content');
            $table->string('image')->nullable();
            $table->string('category')->nullable();
            $table->string('tags')->nullable();
            $table->unsignedBigInteger('user_id')->index('posts_user_id_foreign');
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
        Schema::dropIfExists('posts');
    }
};
