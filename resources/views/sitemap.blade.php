<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">

    @foreach ($posts as $post)
        <url>
            <loc>{{ url('/news', $post->id) }}</loc>
            <lastmod>{{ $post->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
            <news:news>
                <news:publication>
                    <news:news_location>
                        <news:news_location_loc>Беларусь</news:news_location_loc>
                    </news:news_location>
                    <news:news_writer>landi.by</news:news_writer>
                </news:publication>
                <news:news_item>
                    <news:item_section>спецтехника</news:item_section>
                    <news:news_keywords>спецтехника, аренда, продажа, строительство, автомобили</news:news_keywords>
                </news:news_item>
            </news:news>
        </url>
    @endforeach

    @foreach ($bbs as $bb)
        <url>
            <loc>{{ route('bb', $bb->id) }}</loc>
            <lastmod>{{ $bb->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

    @foreach ($rubrics as $rubric)
        <url>
            <loc>{{ route('rubric', $rubric->id) }}</loc>
            <lastmod>{{ $rubric->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.5</priority>
        </url>
    @endforeach

    @foreach ($locations as $location)
        <url>
            <loc>{{ route('location', $location->id) }}</loc>
            <lastmod>{{ $location->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.4</priority>
        </url>
    @endforeach
</urlset>
