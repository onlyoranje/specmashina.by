<?php

use App\Models\Post;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('active')->default('Y');
            $table->string('title');
            $table->text('preview_text')->nullable();

            $table->text('content');
            $table->string('image')->nullable();
            $table->string('category')->nullable();
            $table->string('tags')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });


        $faker = Faker\Factory::create('be_BY');
        /*$cats = $faker->words(20,false);
        $tags = $faker->words(100,false);*/
        for ($i = 1; $i < 300; $i++) {
//$cat  = array_rand($cats,1);

/*$tag = implode(' ,',$faker->words(10));*/
            $post = Post::create([
                'title'=>$faker->sentence(5,true),
                'content'=>$faker->paragraphs(10, false),
                'preview_text'=>$faker->paragraphs(1, false),
                /*'category'=>$cats[$cat],*/
                /*'tags'=>$tag*/

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
        Schema::dropIfExists('posts');
    }
};
