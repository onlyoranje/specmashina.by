<?php

use App\Models\Bb;
use App\Models\BbContact;
use App\Models\BbPrice;
use App\Models\Location;
use App\Models\Rubric;
use App\Models\Status_bb;
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
            $table->foreignId('status_bb_id')->nullable()->constrained();

            $table->string('active',1)->default('N');
            $table->dateTime('lifted_at')->nullable();
            $table->dateTime('premium_until')->nullable();
            $table->timestamps();
            $table->index('created_at');
        });

        $faker = Faker\Factory::create('be_BY');
        for ($i = 1; $i < 2000; $i++) {
            $rubric = Rubric::where('level',2)->inRandomOrder()->limit(1)->first();
            $location = Location::where('level',1)->inRandomOrder()->limit(1)->first();
            $status_bb = Status_bb::inRandomOrder()->limit(1)->first();
            $user = User::where('id',rand(1,32))->limit(1)->first();
            $bb = Bb::create([
                'title'=>$faker->word(),
                'content'=>$faker->text(),
                'rubric_id'=>$rubric->id,
                'vendor_id'=>rand(1,143),
                'location_id'=>$location->id,
                'user_id'=>$user->id,
                'organization_id'=>$user->organization->id,
                'status_bb_id'=>$status_bb->id,
                'active'=>$status_bb->active
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
