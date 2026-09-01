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
        Schema::create('bb_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value');
            $table->unsignedBigInteger('bb_id');
            $table->unsignedBigInteger('contact_type_id')->index('bb_contacts_contact_type_id_foreign');
            $table->timestamps();

            $table->unique(['bb_id', 'contact_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bb_contacts');
    }
};
