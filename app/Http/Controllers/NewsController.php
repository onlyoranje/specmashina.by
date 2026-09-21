<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostStatistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// Новости (Блог) редизайна 2026: список + детальная страница.
// Шаблоны: resources/views/news/{index,show}.blade.php · стили: /css/news.css.
// Данные — модель Post (таблица posts): category и tags — строки,
// tags хранятся списком через запятую, просмотры — сумма по post_statistics.
class NewsController extends Controller
{
    // Уникальные категории активных новостей — для ленты-фильтра над списком.
    private function categories(): array
    {
        return Post::where('active', 'Y')
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->groupBy('category')
            ->orderBy('category')
            ->pluck('category')
            ->all();
    }

    // Уникальные теги (в БД хранятся строкой «экскаваторы, Минск»).
    private function tags(int $limit = 12): array
    {
        $lines = Post::where('active', 'Y')->whereNotNull('tags')->pluck('tags');
        $tags  = [];

        foreach ($lines as $line) {
            foreach (explode(',', $line) as $tag) {
                $tag = trim($tag);
                if ($tag !== '' && !in_array($tag, $tags)) {
                    $tags[] = $tag;
                }
            }
        }

        return array_slice($tags, 0, $limit);
    }

    public function index(Request $request)
    {
        // Лента: активные новости, фильтры «?category=…» и «?tag=…» сохраняются
        // в ссылках пагинации (appends).
        $news = Post::where('active', 'Y')
            ->when($request->filled('category'), fn ($q) => $q->where('category', $request->category))
            ->when($request->filled('tag'), fn ($q) => $q->where('tags', 'like', '%'.$request->tag.'%'))
            ->orderByDesc('id')
            ->paginate(9)
            ->appends($request->query());

        // Самые читаемые: сумма просмотров по post_statistics
        // (приём withSum — как у Bb на главной странице).
        $popular = Post::where('active', 'Y')
            ->withSum('poststatistic', 'views')
            ->orderByDesc('poststatistic_sum_views')
            ->orderByDesc('id')
            ->limit(4)
            ->get();

        return view('news.index', [
            'news'       => $news,
            'categories' => $this->categories(),
            'popular'    => $popular,
            'tags'       => $this->tags(),
        ]);
    }

    public function show(Post $article)
    {
        // Счётчик просмотров: та же логика, что в PostsController::post()
        // (не более одного просмотра в сутки на сессию).
        $stat = PostStatistic::updateOrCreate(['post_id' => $article->id, 'user_token' => Session::getId()]);
        if ($stat->updated_at < date('Y-m-d H:i:s', strtotime('-1 day')) and $stat->user_token == Session::getId()) {
            $stat->fill(['views' => $stat->views + 1]);
            $stat->save();
        } elseif ($stat->user_token != Session::getId()) {
            $stat->fill(['views' => 1]);
            $stat->save();
        }

        // «Читайте также»: свежее из той же категории; если не набралось 3 —
        // добираем последними новостями (кроме текущей).
        $related = Post::where('active', 'Y')
            ->where('id', '!=', $article->id)
            ->when($article->category, fn ($q) => $q->where('category', $article->category))
            ->orderByDesc('id')
            ->limit(3)
            ->get();

        if ($related->count() < 3) {
            $extra = Post::where('active', 'Y')
                ->where('id', '!=', $article->id)
                ->whereNotIn('id', $related->modelKeys())
                ->orderByDesc('id')
                ->limit(3 - $related->count())
                ->get();

            $related = $related->merge($extra);
        }

        return view('news.show', ['article' => $article, 'related' => $related]);
    }
}
