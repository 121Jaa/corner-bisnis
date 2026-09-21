<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $display_name
 * @property string $role
 * @property bool $is_active
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property Carbon|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable(['name', 'email', 'password', 'role', 'display_name', 'is_active'])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        $words = explode(' ', $this->display_name);
        $initials = '';
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
            }
        }
        return substr($initials, 0, 2);
    }

    // ⭐ ==================== HELPER ROLE ====================

    /**
     * Cek apakah user adalah admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user adalah pemilik usaha
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Label role untuk ditampilkan
     */
    public function getRoleLabelAttribute(): string
    {
        return match ($this->role) {
            'admin' => 'Administrator',
            'user' => 'Pemilik Usaha',
            default => 'Tidak Diketahui',
        };
    }

    /**
     * Warna badge role (Tailwind class)
     */
    public function getRoleColorAttribute(): string
    {
        return match ($this->role) {
            'admin' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
            'user' => 'bg-blue-100 text-blue-800 border-blue-300',
            default => 'bg-gray-100 text-gray-800 border-gray-300',
        };
    }

    /**
     * Nama tampilan (fallback ke name kalau kosong)
     */
    public function getDisplayNameAttribute($value): string
    {
        return $value ?: $this->name;
    }

    // ⭐ ==================== RELASI ====================

    /**
     * User punya banyak usaha
     */
    public function businesses()
    {
        return $this->hasMany(Business::class, 'user_id');
    }
}
