<div class="js-cookie-consent cookie-consent" role="dialog" aria-modal="true" aria-label="{{ trans('cookie-consent::texts.policy') }}">
    <div class="cookie-consent__panel">
        <p class="cookie-consent__message">
            {!! trans('cookie-consent::texts.message') !!}
        </p>
        <div class="cookie-consent__actions">
            <a href="{{ route('legal.privacy-policy') }}" class="cookie-consent__link" target="_blank" rel="noopener noreferrer">
                {{ trans('cookie-consent::texts.more') }}
            </a>
            <button type="button" class="cookie-consent__button cookie-consent__button--secondary js-cookie-consent-refuse">
                {{ trans('cookie-consent::texts.refuse') }}
            </button>
            <button type="button" class="cookie-consent__button cookie-consent__button--primary js-cookie-consent-agree">
                {{ trans('cookie-consent::texts.agree') }}
            </button>
            <button type="button" class="cookie-consent__close" onclick="window.laravelCookieConsent?.hideCookieDialog()" aria-label="Закрыть">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    </div>
</div>
