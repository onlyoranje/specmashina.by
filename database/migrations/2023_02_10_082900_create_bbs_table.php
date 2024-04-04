<?php

use App\Models\Bb;
use App\Models\BbContact;
use App\Models\BbPrice;
use App\Models\Location;
use App\Models\Rubric;
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
        Schema::create('bbs', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('rubric_id')->constrained()->cascadeOnDelete();
            $table->foreignId('location_id')->constrained();
            $table->foreignId('vendor_id')->constrained();
            $table->foreignId('organization_id')->nullable();
            $table->text('content')->nullable();
            $table->text('search_text')->nullable();
            $table->foreignId('status_bb_id')->default(1)->constrained();
            $table->dateTime('lifted_at')->nullable();
            $table->dateTime('premium_until')->nullable();
            $table->timestamps();
            $table->index('created_at');
        });

        $faker = Faker\Factory::create('be_BY');
        for ($i = 1; $i < 300; $i++) {
            $rubric = Rubric::where('level',2)->inRandomOrder()->limit(1)->first();
            $location = Location::where('level',1)->inRandomOrder()->limit(1)->first();

            $bb = Bb::create([
                'title'=>rand(100,9999),
                'content'=>$faker->text(),
                'rubric_id'=>$rubric->id,
                'vendor_id'=>rand(1,143),
                'location_id'=>$location->id,
                'user_id'=>rand(1,32),
                'status_bb_id'=>rand(1,10)
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
        Schema::dropIfExists('bbs');
    }
};
