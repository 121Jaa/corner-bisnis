<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteContent extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value', 'type'];

    /**
     * Helper: ambil value berdasarkan key.
     */
    public static function get($key, $default = null)
    {
        $content = self::where('key', $key)->first();
        return $content ? $content->value : $default;
    }

    /**
     * Helper: ambil value JSON (array).
     */
    public static function getJson($key, $default = [])
    {
        $value = self::get($key);
        return $value ? json_decode($value, true) : $default;
    }

    /**
     * Helper: set value.
     */
    public static function set($key, $value, $type = 'text')
    {
        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type]
        );
    }
}
