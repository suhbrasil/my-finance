<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($account) {
            if (Auth::check()) {
                $account->user_id = Auth::id();
            }
        });
    }

    public function releases(): HasMany
    {
        return $this->hasMany(Release::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
