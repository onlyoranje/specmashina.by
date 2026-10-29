<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as FoundationApplication;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * The name of the cache store used for the application settings.
     *
     * @var string
     */
    private const CACHE_KEY = 'app_settings';

    /**
     * The settings keys that are merged into the mail configuration.
     *
     * @var array<int, string>
     */
    private const MAIL_KEYS = [
        'mail.host',
        'mail.port',
        'mail.username',
        'mail.password',
        'mail.encryption',
        'mail.from_address',
        'mail.from_name',
    ];

    /**
     * Register the application settings service.
     */
    public function register(): void
    {
        $this->app->singleton('setting', function (Application $app): SettingService {
            return new SettingService(
                $app['cache'],
                $app['config'],
                $app['events'],
                $app['db']
            );
        });
    }

    /**
     * Bootstrap the application services.
     *
     * @param Factory|View $view
     */
    public function boot(Factory $view): void
    {
        $settings = $this->getSettings();

        // 1. Динамическая перезапись конфигурации почты на лету.
        // Значения из БД имеют приоритет над .env и конфигурационными файлами.
        foreach (self::MAIL_KEYS as $key) {
            if (isset($settings[$key])) {
                $this->setMailConfig($key, $settings[$key]);
            }
        }

        // 2. SEO-настройки становятся доступны в каждом Blade-шаблоне.
        $view->share('seo', $settings);
    }

    /**
     * Fetch settings from the database and cache them for 24 hours.
     *
     * @return array<string, string|null>
     */
    private function getSettings(): array
    {
        $cached = cache()->get(self::CACHE_KEY);

        if ($cached !== null) {
            return (array) $cached;
        }

        $settings = Setting::pluck('value', 'key')->toArray();

        cache()->put(self::CACHE_KEY, $settings, 24 * 60);

        return $settings;
    }

    /**
     * Dynamically overwrite the mail configuration values.
     *
     * @param string $key
     * @param string|null $value
     * @return void
     */
    private function setMailConfig(string $key, $value): void
    {
        $config = $this->app['config'];

        switch ($key) {
            case 'mail.host':
                $config->set('mail.mailers.smtp.host', $value);
                break;

            case 'mail.port':
                $config->set('mail.mailers.smtp.port', is_numeric($value) ? (int) $value : $value);
                break;

            case 'mail.username':
                $config->set('mail.mailers.smtp.username', $value);
                break;

            case 'mail.password':
                $config->set('mail.mailers.smtp.password', $value);
                break;

            case 'mail.encryption':
                $config->set('mail.mailers.smtp.encryption', $value);
                break;

            case 'mail.from_address':
                $config->set('mail.from.address', $value);
                break;

            case 'mail.from_name':
                $config->set('mail.from.name', $value);
                break;
        }
    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return ['setting'];
    }
}
