<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Получаем intended URL из сессии (сохранялся при неавторизованном доступе)
        $intended = $request->session()->pull('url.intended', RouteServiceProvider::HOME);

        $publicUrl = rtrim(trim((string) config('app.public_url')), '/');
        if ($publicUrl === '') {
            $publicUrl = rtrim(trim((string) config('app.url')), '/');
        }

        // Если intended — относительный путь (/dashboard), дополняем до абсолютного
        // с PUBLIC_URL, иначе редирект уйдёт на хост, с которого пришёл запрос
        // (может быть http://192.168.1.5 через прокси Keenetic).
        if ($publicUrl !== '' && !str_starts_with($intended, 'http')) {
            $intended = $publicUrl . $intended;
        }

        // Если в сессии лежит абсолютный URL со старым хостом (http://192.168.1.5/...),
        // заменяем его на PUBLIC_URL (с фолбэком на APP_URL).
        if ($publicUrl !== '' && str_starts_with($intended, 'http')) {
            $intended = preg_replace('#^https?://[^/]+#', $publicUrl, $intended);
        }

        return redirect($intended);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
