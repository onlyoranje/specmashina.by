<?php

use App\Models\BbContact;
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
            $table->id();
            $table->string('value');
            //$table->unsignedBigInteger('bb_id');
            $table->foreignId('bb_id')->constrained()->onDelete ('cascade');
            $table->unsignedBigInteger('contact_type_id');
            $table->foreign('contact_type_id')->references('id')->on('contact_types');
            $table->timestamps();
            $table->unique(['bb_id','contact_type_id']);
        });

        $faker = Faker\Factory::create('ru_RU');
        for ($i = 1; $i < 2000; $i++) {
            BbContact::create(['value' => $faker->name(), 'bb_id' => $i, 'contact_type_id' => 2]);
            BbContact::create(['value' => $faker->phoneNumber(), 'bb_id' => $i, 'contact_type_id' => 1]);
        }
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
