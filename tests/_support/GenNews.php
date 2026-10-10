<?php

use App\Models\Post;
use App\Models\PostStatistic;

Post::truncate();
PostStatistic::truncate();

$cats = ['Новинки', 'Выставки', 'Обзоры', 'Интервью', 'Рынок', 'Технологии'];

try {
    $faker = \Faker\Factory::create('ru_RU');

    $photos = [
        'news/2026-09-01_fairer_luxe_sunroom.jpeg',
        'news/2026-09-05_harmonious_comfortable_bus.jpg',
        'news/2026-09-10_muted_lavender_authentic_cobblestone.jpg',
        'news/2026-09-15_progressive_mixtape_electronics.jpg',
        'news/2026-09-17_dreamy_glam_woodburner_lady.jpg',
        'news/2026-09-20_cool_sweet_lemonade_oven.jpg',
    ];

    $tagsPool = ['спецтехника', 'аренда', 'продажа', 'авто', 'машины', 'Минск', 'Брест', 'Витебск', 'Гомель', 'Гродно', 'Могилев', 'цены', 'товары', 'рынок', 'сделка', 'техника', 'обзор', 'интервью', 'выставка', 'новинка'];

    for ($i = 0; $i < 60; $i++) {
        $cat = $cats[array_rand($cats)];
        $tags = implode(', ', $faker->randomElements($tagsPool, mt_rand(2, 4)));

        $post = Post::create([
            'title'       => $faker->sentence(6, true),
            'preview_text'=> $faker->text(160),
            'content'     => $faker->paragraphs(8, true),
            'image'       => $photos[array_rand($photos)],
            'category'    => $cat,
            'tags'        => $tags,
            'user_id'     => 1,
            'active'      => 'Y',
        ]);

        PostStatistic::create([
            'post_id'  => $post->id,
            'user_token' => 'seed-' . $post->id,
            'views'    => mt_rand(0, 14000),
        ]);
    }

    echo 'Готово'.PHP_EOL;

    $byCat = Post::select('category')
        ->selectRaw('count(*) as total')
        ->selectRaw('sum((image IS NOT NULL AND image != \"\") as images')
        ->groupBy('category')
        ->get();

echo 'post_count=' . Post::count() . PHP_EOL;
echo 'active=' . Post::where('active', 'Y')->count() . PHP_EOL;
echo 'cats=' . json_encode($byCat->toArray()) . PHP_EOL;

} catch (\Throwable $e) {
    echo 'ERROR: ' . $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
    exit(1);
}
