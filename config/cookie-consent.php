<?php

return [

    /*
     * Use this setting to enable the cookie consent dialog.
     */
    'enabled' => env('COOKIE_CONSENT_ENABLED', true),

    /*
     * The name of the cookie in which we store if the user
     * has agreed to accept the conditions.
     */
    'cookie_name' => 'laravel_cookie_consent',

    /*
     * The name of the cookie in which we store if the user
     * has refused cookies (no tracking/analytics).
     */
    'cookie_refuse_name' => 'laravel_cookie_consent_refused',

    /*
     * Set the cookie duration in days.  Default is 365 * 20.
     */
    'cookie_lifetime' => 365 * 20,
];
