<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('cookie_id', 64)->unique()->comment('visitor_id из куки');
            $table->timestamp('first_seen_at')->nullable();
            $table->timestamp('last_seen_at')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->boolean('consent_granted')->default(false);
            $table->timestamp('consent_at')->nullable();
            $table->timestamps();

            $table->index('last_seen_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};