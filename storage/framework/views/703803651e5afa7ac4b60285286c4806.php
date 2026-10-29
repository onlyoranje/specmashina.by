
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['listing' => null, 'equipment' => null]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['listing' => null, 'equipment' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $bb  = $listing ?? $equipment;
    $url = route('listings.show', $bb->id);

    $file  = $bb->images()->first();
    $price = $bb->bbprice;
    $unit  = $price?->pricetype?->type;               // «руб/час», «руб/день», «руб»

    // Тип сделки (плашка «Аренда»/«Продажа») задаёт РАЗДЕЛ — корневая рубрика
    // объявления: id 2000 «Продажа», id 1000 «Аренда». Раньше плашка определялась
    // по единице цены (type === 'руб' → «Продажа»), но в данных все цены имеют
    // тип «руб» (нет «руб/час»/«руб/день»), из-за чего арендные объявления тоже
    // получали плашку «Продажа». Логика согласована с CatalogController
    // (rootId 2000/1000) и catalog/location.blade.php.
    $rootRubricId = method_exists($bb, 'parent_rubric')
        ? ($bb->parent_rubric()->id ?? null)
        : null;
    $isSale = $rootRubricId === 2000;

    // Есть ли у цены период тарификации («руб/час», «руб/день») — от этого
    // зависит ФОРМАТ цены («/ час», «/ смена»), а НЕ тип сделки. Тип «руб»
    // (или отсутствие цены) — цена без периода.
    $hasPeriod = (bool) $unit && $unit !== 'руб';
    $unitShort = 'час';
    if ($unit && str_contains($unit, 'день')) {
        $unitShort = 'смена';
    } elseif ($hasPeriod) {
        $unitShort = str_replace('руб/', '', $unit);
    }

    // До 4 тегов характеристик: «Масса: 20 т», «Ковш: 1.1 м³», «С оператором»…
    $tags = $bb->BbParameters->filter(fn ($p) => $p->parameters)->take(4);
?>

<article class="eq-card">

    
    <div class="eq-card__media">
        <a class="eq-card__media-link" href="<?php echo e($url); ?>" tabindex="-1" aria-hidden="true">
            <?php if($file): ?>
                <img class="card-img"
                     src="<?php echo e(resizeImage($file->url, 480, 360)); ?>"
                     alt="<?php echo e($bb->title()); ?>"
                     title="<?php echo e($bb->title() . ' — ' . ($price?->price ?? '') . ($unit ? ' ' . $unit : '') . ' в Беларуси'); ?>"
                     loading="lazy">
            <?php else: ?>
                <img class="card-img card-img--placeholder"
                     src="<?php echo e(asset('images/placeholder/no-image.svg')); ?>"
                     alt="Фото не добавлено" loading="lazy">
            <?php endif; ?>
        </a>
        <span class="<?php echo \Illuminate\Support\Arr::toCssClasses(['eq-card__badge', 'eq-card__badge--sale' => $isSale]); ?>">
            <?php echo e($isSale ? 'Продажа' : 'Аренда'); ?>

        </span>
    </div>

    
    <div class="eq-card__body">
        <h3 class="eq-card__title">
            <a href="<?php echo e($url); ?>"><?php echo e($bb->title()); ?></a>
        </h3>

        <p class="eq-card__meta">
            <span class="eq-card__meta-item">
                <svg width="12" height="12" viewBox="0 0 16 16" aria-hidden="true"><path d="M8 1.5A4.5 4.5 0 0 1 12.5 6c0 3.2-4.5 8.5-4.5 8.5S3.5 9.2 3.5 6A4.5 4.5 0 0 1 8 1.5Z" fill="none" stroke="currentColor" stroke-width="1.5"/><circle cx="8" cy="6" r="1.6" fill="currentColor"/></svg>
                <?php echo e($bb->location?->title ?? 'Беларусь'); ?>

            </span>
            <span class="eq-card__meta-item"><?php echo e(optional($bb->created_at)->format('d.m.Y')); ?></span>
        </p>

        <?php if($tags->isNotEmpty()): ?>
            <ul class="eq-card__tags">
                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($tag->parameters->name); ?>: <?php echo e($tag->value); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
    </div>

    
    <div class="eq-card__action">
        <p class="eq-card__price-label"><?php echo e($isSale ? 'Цена' : 'Цена от'); ?></p>

        <?php if($hasPeriod): ?>
            <p class="eq-card__price">
                от <?php echo e(number_format((float) $price->price, 0, '', ' ')); ?> <span>BYN / <?php echo e($unitShort); ?></span>
            </p>
        <?php else: ?>
            <p class="eq-card__price">
                <?php echo e(number_format($price?->price ?? 0, 0, '', ' ')); ?> <span>BYN</span>
            </p>
        <?php endif; ?>

        <a class="btn-action" href="<?php echo e($url); ?>">Показать контакты</a>
    </div>
</article>
<?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/components/equipment-card.blade.php ENDPATH**/ ?>