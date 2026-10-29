<?php

namespace App\Http\Controllers;

use App\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isadmin']);
    }

    /**
     * Настройки почты.
     */
    public function mailSettings(SettingService $settingService)
    {
        $settings = $settingService->all();
        $mailKeys = $settingService->getMailKeys();

        $mailSettings = [];
        foreach ($mailKeys as $key) {
            $mailSettings[$key] = $settings[$key] ?? null;
        }

        return view('settings.mail', [
            'title'   => 'Настройки почты',
            'mailSettings' => $mailSettings,
        ]);
    }

    /**
     * Сохранение настроек почты.
     */
    public function mailSettingsSave(Request $request, SettingService $settingService)
    {
        $validated = $request->validate([
            'mail.host'     => 'nullable|string|max:255',
            'mail.port'     => 'nullable|integer|min:1|max:65535',
            'mail.username' => 'nullable|string|max:255',
            'mail.password' => 'nullable|string',
            'mail.encryption' => 'nullable|string|max:20',
            'mail.from_address' => 'nullable|email|max:255',
            'mail.from_name'    => 'nullable|string|max:255',
        ]);

        foreach ($validated as $key => $value) {
            $settingService->set($key, $value);
        }

        Cache::forget('app_settings');

        return redirect()->route('settings.mail')->with('status', 'Настройки почты сохранены.');
    }

    /**
     * Отправка тестового письма на info@landi.by.
     * Использует SMTP-настройки, сохранённые в таблице settings.
     */
    public function mailTest(Request $request, SettingService $settingService)
    {
        $settings = $settingService->all();

        Log::debug('mailTest: entered', [
            'settings' => array_filter($settings, fn ($k) => str_starts_with($k, 'mail.'), ARRAY_FILTER_USE_KEY),
        ]);

        // Подставляем SMTP-настройки из БД в конфиг почты перед отправкой.
        Config::set('mail.mailers.smtp.host',     $settings['mail.host']     ?? null);
        Config::set('mail.mailers.smtp.port',     $settings['mail.port']     ?? null);
        Config::set('mail.mailers.smtp.encryption', $settings['mail.encryption'] ?? null);
        Config::set('mail.mailers.smtp.username', $settings['mail.username'] ?? null);
        Config::set('mail.mailers.smtp.password', $settings['mail.password'] ?? null);
        Config::set('mail.from.address',          $settings['mail.from_address'] ?? null);
        Config::set('mail.from.name',             $settings['mail.from_name'] ?? null);

        Log::debug('mailTest: mail config set', [
            'host'     => config('mail.mailers.smtp.host'),
            'port'     => config('mail.mailers.smtp.port'),
            'encryption' => config('mail.mailers.smtp.encryption'),
            'username' => config('mail.mailers.smtp.username'),
            'from'     => config('mail.from.address'),
        ]);

        try {
            Mail::raw('ТЕСТ — проверочное письмо от SpecMashina.by.', function ($message) use ($settings) {
                $message->from($settings['mail.from_address'] ?? 'no-reply@specmashina.by',
                             $settings['mail.from_name'] ?? 'SpecMashina')
                    ->to('47@terwa.by')
                    ->subject('Тестовое письмо (SpecMashina)');
            });

            Log::debug('mailTest: mail sent successfully');

            return redirect()->route('settings.mail')->with('status', 'Тестовое письмо отправлено на 47@terwa.by.');
        } catch (\Throwable $e) {
            Log::error('mailTest: mail send failed', [
                'message' => $e->getMessage(),
                'class'   => get_class($e),
                'trace'   => $e->getTraceAsString(),
            ]);

            return redirect()->route('settings.mail')->with('error', 'Ошибка отправки тестового письма: ' . $e->getMessage());
        }
    }

    /**
     * Настройка сайта (контактные данные и реквизиты).
     */
    public function siteSettings(SettingService $settingService)
    {
        $settings = $settingService->all();

        $siteSettings = [];
        foreach (['site.name', 'site.domain', 'site.phone', 'site.email', 'site.address', 'site.work_hours'] as $key) {
            $siteSettings[$key] = $settings[$key] ?? null;
        }

        return view('settings.site', [
            'title'         => 'Настройка сайта',
            'siteSettings'  => $siteSettings,
        ]);
    }

    /**
     * Сохранение настроек сайта.
     */
    public function siteSettingsSave(Request $request, SettingService $settingService)
    {
        $validated = $request->validate([
            'site.name'      => 'nullable|string|max:255',
            'site.domain'    => 'nullable|string|max:255',
            'site.phone'     => 'nullable|string|max:50',
            'site.email'     => 'nullable|email|max:255',
            'site.address'   => 'nullable|string|max:255',
            'site.work_hours'=> 'nullable|string|max:100',
        ]);

        foreach ($validated as $key => $value) {
            $settingService->set($key, $value);
        }

        Cache::forget('app_settings');

        return redirect()->route('settings.site')->with('status', 'Настройки сайта сохранены.');
    }

    /**
     * Настройка SEO.
     */
    public function seoSettings(SettingService $settingService)
    {
        $settings = $settingService->all();

        $seoSettings = [];
        foreach (['seo.title', 'seo.description', 'seo.keywords'] as $key) {
            $seoSettings[$key] = $settings[$key] ?? null;
        }

        return view('settings.seo', [
            'title'       => 'Настройка SEO',
            'seoSettings' => $seoSettings,
        ]);
    }

    /**
     * Сохранение настроек SEO.
     */
    public function seoSettingsSave(Request $request, SettingService $settingService)
    {
        $validated = $request->validate([
            'seo.title'       => 'nullable|string|max:255',
            'seo.description' => 'nullable|string|max:500',
            'seo.keywords'    => 'nullable|string|max:500',
        ]);

        foreach ($validated as $key => $value) {
            $settingService->set($key, $value);
        }

        Cache::forget('app_settings');

        return redirect()->route('settings.seo')->with('status', 'Настройки SEO сохранены.');
    }
}