<?php

use App\Models\Location;
use App\Models\Organization;
use App\Models\User;
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
            $table->id();
            $table->string('title');
            $table->foreignId('location_id')->constrained();
            $table->string('address');
            $table->string('unp');
            $table->string('site')->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->string('phone')->nullable();
            $table->text('content')->nullable();
            $table->string('active')->default('Y');
            $table->string('approve')->default('N');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
