/*
 * specmashina.by — клиентский модуль сбора событий (tracking collector)
 * Работает только после получения согласия на куки (cookie-consent).
 */

(function () {
    'use strict';

    // ---------------- Конфигурация ----------------
    var CONFIG = {
        endpoint: '/collect',
        consentCookieName: 'laravel_cookie_consent',
        refuseCookieName: 'laravel_cookie_consent_refused',
        visitorCookieName: 'visitor_id',
        sessionCookieName: 'tracking_session_id',
        batchInterval: 30000,
        maxBatchSize: 20,
        storageKey: 'tracking_queue',
    };

    // ---------------- Вспомогательные функции ----------------
    function getCookie(name) {
        var match = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + '=([^;]*)'));
        return match ? decodeURIComponent(match[1]) : null;
    }

    function setCookie(name, value, days) {
        var date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        document.cookie = name + '=' + encodeURIComponent(value) +
            ';expires=' + date.toUTCString() +
            ';path=/;SameSite=Lax';
    }

    function generateVisitorId() {
        if (typeof crypto !== 'undefined' && typeof crypto.randomUUID === 'function') {
            return crypto.randomUUID();
        }
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
            var r = Math.random() * 16 | 0;
            return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
        });
    }

    function throttle(fn, limit) {
        var waiting = false;
        return function () {
            if (!waiting) {
                waiting = true;
                setTimeout(function () { waiting = false; }, limit);
                fn.apply(this, arguments);
            }
        };
    }

    function getCsrfToken() {
        var meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    }

    // ---------------- Состояние ----------------
    var state = {
        enabled: false,
        visitorId: null,
        sessionId: null,
        queue: [],
        batchTimer: null,
        consent: {
            necessary: false,
            analytics: false,
            marketing: false,
        },
    };

    // ---------------- Проверка согласия ----------------
    function checkConsent() {
        var agreed = getCookie(CONFIG.consentCookieName) === '1';
        var refused = getCookie(CONFIG.refuseCookieName) === '1';

        if (refused) {
            state.enabled = false;
            return;
        }

        if (!agreed) {
            state.enabled = false;
            return;
        }

        var settingsCookie = getCookie('cookie_consent_settings');
        if (settingsCookie) {
            try {
                state.consent = JSON.parse(settingsCookie);
            } catch (e) {
                state.consent = { necessary: true, analytics: true, marketing: false };
            }
        } else {
            state.consent = { necessary: true, analytics: true, marketing: false };
        }

        state.enabled = state.consent.necessary === true;
    }

    // ---------------- Инициализация ----------------
    function init() {
        checkConsent();
        if (!state.enabled) {
            return;
        }

        state.visitorId = getCookie(CONFIG.visitorCookieName);
        if (!state.visitorId) {
            state.visitorId = generateVisitorId();
            setCookie(CONFIG.visitorCookieName, state.visitorId, 365 * 20);
        }

        state.sessionId = getCookie(CONFIG.sessionCookieName);
        if (!state.sessionId) {
            state.sessionId = generateVisitorId();
            setCookie(CONFIG.sessionCookieName, state.sessionId, 1);
        }

        try {
            var stored = localStorage.getItem(CONFIG.storageKey);
            if (stored) {
                state.queue = JSON.parse(stored);
            }
        } catch (e) {
            state.queue = [];
        }

        trackPageView();
        bindClicks();
        trackScrollDepth();
        trackTimeOnPage();

        startBatch();

        window.addEventListener('online', function () {
            flush();
        });
    }

    // ---------------- События ----------------
    function pushEvent(type, payload) {
        if (!state.enabled) return;

        state.queue.push({
            type: type,
            payload: payload || {},
            timestamp: Date.now(),
        });

        try {
            localStorage.setItem(CONFIG.storageKey, JSON.stringify(state.queue));
        } catch (e) {
            // ignore quota errors
        }

        if (state.queue.length >= CONFIG.maxBatchSize) {
            flush();
        }
    }

    function trackPageView() {
        pushEvent('page_view', {
            path: window.location.pathname,
            referrer: document.referrer,
            title: document.title,
        });
    }

    function bindClicks() {
        document.addEventListener('click', function (e) {
            var target = e.target.closest('a, button');
            if (!target) return;

            var isOutbound = target.hostname && target.hostname !== window.location.hostname;
            pushEvent(isOutbound ? 'outbound_link_click' : 'click', {
                target: target.tagName,
                text: (target.innerText || '').trim().slice(0, 100),
                href: target.href || null,
                outbound: isOutbound,
            });
        });
    }

    function trackScrollDepth() {
        var thresholds = [25, 50, 75, 100];
        var reached = new Set();

        var onScroll = function () {
            var winHeight = window.innerHeight;
            var docHeight = document.documentElement.scrollHeight;
            var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            var pct = Math.round(((scrollTop + winHeight) / Math.max(docHeight, 1)) * 100);

            for (var i = 0; i < thresholds.length; i++) {
                var t = thresholds[i];
                if (pct >= t && !reached.has(t)) {
                    reached.add(t);
                    pushEvent('scroll_depth', { depth: t });
                }
            }
        };

        window.addEventListener('scroll', throttle(onScroll, 1000), { passive: true });
    }

    function trackTimeOnPage() {
        var start = Date.now();

        var sendTime = function () {
            pushEvent('time_on_page', {
                seconds: Math.round((Date.now() - start) / 1000),
            });
        };

        document.addEventListener('visibilitychange', function () {
            if (document.visibilityState === 'hidden') {
                sendTime();
                flush(true);
            }
        });

        window.addEventListener('beforeunload', function () {
            sendTime();
            flush(true);
        });
    }

    // ---------------- Отправка ----------------
    function flush(useBeacon) {
        if (state.queue.length === 0) return;

        var events = state.queue.splice(0, state.queue.length);
        try {
            localStorage.setItem(CONFIG.storageKey, JSON.stringify(state.queue));
        } catch (e) {
            // ignore
        }

        var payload = JSON.stringify({
            events: events,
            visitor_id: state.visitorId,
            session_id: state.sessionId,
            url: window.location.href,
            user_agent: navigator.userAgent,
        });

        if (useBeacon && navigator.sendBeacon) {
            var blob = new Blob([payload], { type: 'application/json' });
            var form = new FormData();
            form.append('_token', getCsrfToken());
            form.append('payload', payload);
            navigator.sendBeacon(CONFIG.endpoint, form);
            return;
        }

        fetch(CONFIG.endpoint, {
            method: 'POST',
            credentials: 'include',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json',
            },
            body: payload,
        }).catch(function () {
            state.queue.unshift.apply(state.queue, events);
            try {
                localStorage.setItem(CONFIG.storageKey, JSON.stringify(state.queue));
            } catch (e) {
                // ignore
            }
        });
    }

    function startBatch() {
        if (state.batchTimer) clearInterval(state.batchTimer);
        state.batchTimer = setInterval(function () {
            flush();
        }, CONFIG.batchInterval);
    }

    // ---------------- Публичный API ----------------
    window.specTracker = {
        push: pushEvent,
        flush: flush,
        enabled: function () { return state.enabled; },
        visitorId: function () { return state.visitorId; },
    };

    // Запуск после загрузки DOM
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
