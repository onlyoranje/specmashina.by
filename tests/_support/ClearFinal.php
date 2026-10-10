<?php

use App\Models\Post;
use App\Models\PostStatistic;

Post::truncate();
PostStatistic::truncate();

echo 'Cleared posts=' . Post::count() . PHP_EOL;
echo 'Cleared stats=' . PostStatistic::count() . PHP_EOL;
