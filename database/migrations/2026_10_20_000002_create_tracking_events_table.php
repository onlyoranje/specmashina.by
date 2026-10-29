<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracking_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id')->constrained('visitors')->onDelete('cascade');
            $table->foreignId('tracking_session_id')->nullable()->constrained('tracking_sessions')->nullOnDelete();
            $table->string('type', 32)->comment('page_view, click, scroll_depth, time_on_page и т.д.');
            $table->json('payload')->nullable();
            $table->unsignedInteger('timestamp')->comment('Unix-время на клиенте');
            $table->timestamp('received_at')->useCurrent();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('url', 2000)->nullable();

            $table->index(['visitor_id', 'type']);
            $table->index('received_at');
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracking_events');
    }
};