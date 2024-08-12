<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'lung_id',
        'name',
        'user_id',
    ];

    protected static function booted()
    {
        static::creating(function ($category) {
            $category->user_id = Auth::id();
        });
    }

    public function releases(): HasMany
    {
        return $this->hasMany(Release::class);
    }

    public function lung(): BelongsTo
    {
        return $this->belongsTo(Lung::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
