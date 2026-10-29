<?php

namespace App;

use Illuminate\Contracts\Cache\Factory as Cache;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Events\Dispatcher as Events;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Str;

/**
 * Сервис для работы с настройками приложения.
 *
 * Кэширует настройки в «app_settings» на 24 часа и отвечает за
 * динамическую подмену конфигурации почты на лету.
 */
class SettingService
{
    /**
     * @var Cache
     */
    protected $cache;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Events
     */
    protected $events;

    /**
     * @var DatabaseManager
     */
    protected $db;

    /**
     * @var array<int, string>
     */
    protected $mailKeys = [
        'mail.host',
        'mail.port',
        'mail.username',
        'mail.password',
        'mail.encryption',
        'mail.from_address',
        'mail.from_name',
    ];

    /**
     * @param Cache $cache
     * @param Config $config
     * @param Events $events
     * @param DatabaseManager $db
     */
    public function __construct(
        Cache $cache,
        Config $config,
        Events $events,
        DatabaseManager $db
    ) {
        $this->cache = $cache;
        $this->config = $config;
        $this->events = $events;
        $this->db = $db;
    }

    /**
     * Get all settings as an array.
     *
     * @return array<string, mixed>
     */
    public function all(): array
    {
        $key = 'app_settings';

        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }

        $settings = $this->db->table('settings')->pluck('value', 'key')->toArray();

        $this->cache->put($key, $settings, 24 * 60);

        return $settings;
    }

    /**
     * Get a single setting by key.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return data_get($this->all(), $key, $default);
    }

    /**
     * Set a setting value.
     *
     * @param string $key
     * @param mixed $value
     * @param bool $cast
     * @return $this
     */
    public function set(string $key, $value, bool $cast = false): self
    {
        if ($cast) {
            $value = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        $this->db->table('settings')->updateOrInsert(
            ['key' => $key],
            ['value' => $value, 'updated_at' => now()]
        );

        return $this;
    }

    /**
     * Remove a setting.
     *
     * @param string $key
     * @return bool
     */
    public function forget(string $key): bool
    {
        return $this->db->table('settings')->where('key', $key)->delete();
    }

    /**
     * Flush all settings and invalidate the cache.
     *
     * @return int
     */
    public function flush(): int
    {
        $this->db->table('settings')->truncate();

        $this->cache->forget('app_settings');

        return $this->db->table('settings')->count();
    }

    /**
     * Merge settings into the mail configuration.
     *
     * @param array<string, mixed> $settings
     * @return void
     */
    public function mergeMailConfig(array $settings): void
    {
        foreach ($this->mailKeys as $key) {
            if (array_key_exists($key, $settings)) {
                $this->config->set($key, $settings[$key]);
            }
        }
    }

    /**
     * Get the mail configuration keys managed by this service.
     *
     * @return array<int, string>
     */
    public function getMailKeys(): array
    {
        return $this->mailKeys;
    }
}