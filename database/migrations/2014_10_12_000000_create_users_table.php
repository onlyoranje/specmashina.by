<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('realname');
            $table->string('email')->nullable();;
            $table->string('phone')->nullable();;
            $table->string('avatar')->nullable();;
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->boolean('is_admin')->default('0');
            $table->rememberToken();
            $table->timestamps();
        });

        User::create(['name' => 'admin', 'realname' => 'Максим','email' => '47@terwa.by','password' => Hash::make('12345678'),'is_admin'=>'1']);
        User::create(['name' => 'user', 'realname' => 'Вова','email' => '48@terwa.by','password' => Hash::make('12345678')]);

        $faker = Faker\Factory::create('ru_RU');
        for ($i = 0; $i < 30; $i++) {
            User::create(['name' => Str::random(8), 'phone'=>$faker->phoneNumber(), 'email'=>$faker->email(), 'realname' => $faker->name(),'email' => $faker->email(),'password' => Hash::make(Str::random(8))]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
