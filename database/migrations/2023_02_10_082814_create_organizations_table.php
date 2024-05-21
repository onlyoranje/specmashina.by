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
            $table->string('active')->default('Y');
            $table->string('approve')->default('N');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        $faker = Faker\Factory::create('ru_RU');
        for ($i = 1; $i < 33; $i++) {
            $location = Location::where('level',1)->inRandomOrder()->limit(1)->first();
            $user = User::where('id',$i)->limit(1)->first();
            Organization::create(
                ['title' => $faker->company,
                    'location_id'=>$location->id,
                    'phone'=>$faker->phoneNumber(),
                    'email'=>$faker->email(),
                    'address' => $faker->address(),
                    'unp' => rand(100000000,799999999),
                    'user_id'=>$user->id
                ]);
        }
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
