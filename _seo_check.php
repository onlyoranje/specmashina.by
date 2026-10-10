<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$path = $argv[1] ?? '/';
$res = $kernel->handle(Illuminate\Http\Request::create($path, 'GET'));
$html = $res->getContent();
echo "STATUS: " . $res->getStatusCode() . PHP_EOL;
if (preg_match('#<title>(.*?)</title>#s', $html, $m)) echo "TITLE: " . trim(html_entity_decode($m[1])) . PHP_EOL;
if (preg_match('#og:title" content="([^"]*)"#', $html, $m)) echo "OG:TITLE: " . html_entity_decode($m[1]) . PHP_EOL;
if (preg_match('#rel="canonical" href="([^"]*)"#', $html, $m)) echo "CANONICAL: " . $m[1] . PHP_EOL;
preg_match_all('#<h1[^>]*>(.*?)</h1>#s', $html, $h1s);
echo "H1 COUNT: " . count($h1s[1]) . PHP_EOL;
foreach ($h1s[1] as $h) echo "  H1: " . trim(strip_tags(preg_replace('/\s+/', ' ', html_entity_decode($h)))) . PHP_EOL;
preg_match_all('#<main#', $html, $mains);
echo "MAIN COUNT: " . count($mains[0]) . PHP_EOL;
