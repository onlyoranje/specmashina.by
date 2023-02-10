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
        Schema::create('bbs', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('rubric_id')->constrained()->cascadeOnDelete();
            $table->foreignId('location_id')->constrained();
            $table->foreignId('vendor_id')->constrained();
            $table->foreignId('organization_id')->constrained();
            $table->text('content')->nullable();
            $table->float('price');
            $table->timestamps();
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bbs');
    }
};
