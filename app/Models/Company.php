<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const TABLE_NAME = 'companies';

    protected $fillable = [
        'name',
        'catch_phrase',
        'bs',
    ];

    protected $table = self::TABLE_NAME;

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
