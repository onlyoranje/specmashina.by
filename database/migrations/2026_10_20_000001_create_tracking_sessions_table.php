<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracking_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id')->constrained('visitors')->onDelete('cascade');
            $table->string('session_id', 64)->unique()->comment('ID сессии посетителя');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();

            $table->index('visitor_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracking_sessions');
    }
};