<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property \Illuminate\Support\Collection<\App\Models\User> followers
 * @property \Illuminate\Support\Collection<\App\Models\User> followings
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    public const TABLE_NAME = 'users';

    public const USER_FOLLOWS_TABLE = 'user_follows';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $table = self::TABLE_NAME;

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function followers(): BelongsToMany
    {
        return $this
            ->belongsToMany(
                self::class,
                self::USER_FOLLOWS_TABLE,
                'followed_id',
                'user_id'
            )
            ->withTimestamps();
    }

    public function followings(): BelongsToMany
    {
        return $this
            ->belongsToMany(
                self::class,
                self::USER_FOLLOWS_TABLE,
                'user_id',
                'followed_id'
            )
            ->withTimestamps();
    }
}
