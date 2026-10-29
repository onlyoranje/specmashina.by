<div class="js-cookie-consent cookie-consent" role="dialog" aria-modal="true" aria-label="<?php echo e(trans('cookie-consent::texts.policy')); ?>">
    <div class="cookie-consent__panel">
        <p class="cookie-consent__message">
            <?php echo trans('cookie-consent::texts.message'); ?>

        </p>
        <div class="cookie-consent__actions">
            <a href="<?php echo e(route('legal.privacy-policy')); ?>" class="cookie-consent__link" target="_blank" rel="noopener noreferrer">
                <?php echo e(trans('cookie-consent::texts.more')); ?>

            </a>
            <button type="button" class="cookie-consent__button cookie-consent__button--secondary js-cookie-consent-refuse">
                <?php echo e(trans('cookie-consent::texts.refuse')); ?>

            </button>
            <button type="button" class="cookie-consent__button cookie-consent__button--primary js-cookie-consent-agree">
                <?php echo e(trans('cookie-consent::texts.agree')); ?>

            </button>
            <button type="button" class="cookie-consent__close" onclick="window.laravelCookieConsent?.hideCookieDialog()" aria-label="Закрыть">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    </div>
</div>
<?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/vendor/cookie-consent/dialogContents.blade.php ENDPATH**/ ?>