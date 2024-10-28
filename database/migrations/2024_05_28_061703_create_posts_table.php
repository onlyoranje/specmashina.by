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


        $faker = Faker\Factory::create('en_US');
        $cats = array("Новинки","Выставки","Обзоры","Интервью","Рынок труда","Технологии");
        $tags = $faker->words(30,false);
        for ($i = 1; $i < 150; $i++) {
//$cat  = array_rand($cats,1);

$tag = implode(',',$faker->words(10,false));
            $post = Post::create([
                'title'=>$faker->text(50),
                'content'=>implode('<br>',$faker->paragraphs(20)),
                'preview_text'=>$faker->text(100),
                'category'=>$cats[rand(0,5)],
                'user_id'=>1,
                'tags'=>$tag

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
