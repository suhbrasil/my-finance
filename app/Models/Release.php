<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Release extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'category_id',
        'description',
        'lung_id',
        'user_id',
        'account_id',
        'value',
        'deposit'
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function lung(): BelongsTo
    {
        return $this->belongsTo(Lung::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
