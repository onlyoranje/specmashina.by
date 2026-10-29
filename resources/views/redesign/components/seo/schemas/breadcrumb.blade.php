<?php
$breadcrumbList = [];
$i = 0;
if (isset($breadcrumbs) && is_array($breadcrumbs) && isset($breadcrumbs['list']) && is_array($breadcrumbs['list'])) {
    foreach ($breadcrumbs['list'] as $crumb) {
        if (is_object($crumb)) {
            $crumbUrl = is_numeric($crumb->id) ? route('bb', $crumb->id) : route('rubric', $crumb->id);
        } elseif (is_array($crumb)) {
            $crumbUrl = route($crumb['route'], $crumb['param'] ?? []);
        } else {
            continue;
        }
        $breadcrumbList[] = [
            '@type' => 'ListItem',
            'position' => ++$i,
            'name' => $crumb->title ?? $crumb['title'] ?? 'Главная',
            'item' => $crumbUrl,
        ];
    }
}
$current = $__env->yieldContent('title');
if (!empty($current) && trim($current) !== 'Главная') {
    $breadcrumbList[] = [
        '@type' => 'ListItem',
        'position' => ++$i,
        'name' => trim($current),
        'item' => url()->current(),
    ];
}
?>
<?php
return json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => $breadcrumbList,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>
