<?php

use App\Models\Location;
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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('title',100);

            //$table->unsignedBigInteger('parent_id')->nullable();
            //$table->foreign('parent_id')->references('id')->on('locations')->onDelete('restrict');
            $table->unsignedBigInteger('sort')->default(500);
            $table->nestedSet();
            $table->unsignedBigInteger('level')->nullable();
            $table->timestamps();
        });
        Location::create(['title' => 'Орша','level' => 0]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
};
