<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

final class Option extends Model
{
    public $primaryKey = 'key';

    public $timestamps = false;

    protected $fillable = ['key', 'value'];

    /**
     * Get the specified option value.
     */
    public static function get(string $key, $default = null)
    {
        return self::loadAll()[$key] ?? $default;
    }

    /**
     * Set the given option value or array of values.
     */
    public static function set(string|array $key, $value = null)
    {
        if (! is_array($key)) {
            return self::query()
                ->updateOrCreate(['key' => $key], ['value' => $value]);
        }

        foreach ($key as $k => $v) {
            self::set($k, $v);
        }
    }

    /**
     * Refresh cache to sync with database.
     */
    public static function refreshCache(): void
    {
        Cache::forget('app.models.option');
        self::loadAll();
    }

    /**
     * Load all options from database and keep it in cache.
     */
    public static function loadAll(): ?array
    {
        return Cache::rememberForever(
            'app.models.option',
            fn () => self::pluck('value', 'key')->toArray()
        );
    }

    /**
     * {@inheritDoc}
     */
    protected static function booted(): void
    {
        self::saved(fn () => self::refreshCache());
        self::deleted(fn () => self::refreshCache());
    }
}
