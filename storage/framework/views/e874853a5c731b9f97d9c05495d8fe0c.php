<?php
    $refuseCookieName = $cookieConsentConfig['cookie_refuse_name'] ?? 'laravel_cookie_consent_refused';
    $alreadyRefused = isset($_COOKIE[$refuseCookieName]) && $_COOKIE[$refuseCookieName] == '1';
?>
<?php if($cookieConsentConfig['enabled'] && ! $alreadyConsentedWithCookies && ! $alreadyRefused): ?>
    <?php echo $__env->make('cookie-consent::dialogContents', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <script>

        window.laravelCookieConsent = (function () {

            const COOKIE_VALUE = 1;
            const COOKIE_DOMAIN = '<?php echo e(config('session.domain') ?? request()->getHost()); ?>';
            const REFUSE_COOKIE_NAME = '<?php echo e($cookieConsentConfig['cookie_refuse_name']); ?>';

            function consentWithCookies() {
                setCookie('<?php echo e($cookieConsentConfig['cookie_name']); ?>', COOKIE_VALUE, <?php echo e($cookieConsentConfig['cookie_lifetime']); ?>);
                hideCookieDialog();
                location.reload();
            }

            function refuseCookies() {
                setCookie(REFUSE_COOKIE_NAME, COOKIE_VALUE, <?php echo e($cookieConsentConfig['cookie_lifetime']); ?>);
                hideCookieDialog();
                location.reload();
            }

            function cookieExists(name) {
                return (document.cookie.split('; ').indexOf(name + '=' + COOKIE_VALUE) !== -1);
            }

            function hideCookieDialog() {
                const dialogs = document.getElementsByClassName('js-cookie-consent');

                for (let i = 0; i < dialogs.length; ++i) {
                    dialogs[i].style.display = 'none';
                }
            }

            function setCookie(name, value, expirationInDays) {
                const date = new Date();
                date.setTime(date.getTime() + (expirationInDays * 24 * 60 * 60 * 1000));
                document.cookie = name + '=' + value
                    + ';expires=' + date.toUTCString()
                    + ';domain=' + COOKIE_DOMAIN
                    + ';path=/<?php echo e(config('session.secure') ? ';secure' : null); ?>'
                    + '<?php echo e(config('session.same_site') ? ';samesite='.config('session.same_site') : null); ?>';
            }

            if (cookieExists('<?php echo e($cookieConsentConfig['cookie_name']); ?>') || cookieExists('<?php echo e($cookieConsentConfig['cookie_refuse_name']); ?>')) {
                hideCookieDialog();
            }

            const agreeButtons = document.getElementsByClassName('js-cookie-consent-agree');

            for (let i = 0; i < agreeButtons.length; ++i) {
                agreeButtons[i].addEventListener('click', consentWithCookies);
            }

            const refuseButtons = document.getElementsByClassName('js-cookie-consent-refuse');

            for (let i = 0; i < refuseButtons.length; ++i) {
                refuseButtons[i].addEventListener('click', refuseCookies);
            }

            return {
                consentWithCookies: consentWithCookies,
                refuseCookies: refuseCookies,
                hideCookieDialog: hideCookieDialog
            };
        })();
    </script>

<?php endif; ?>
<?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/vendor/cookie-consent/index.blade.php ENDPATH**/ ?>