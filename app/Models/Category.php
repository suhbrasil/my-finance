<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'lung_id',
        'name'
    ];

    public function releases(): HasMany
    {
        return $this->hasMany(Release::class);
    }

    public function lung(): BelongsTo
    {
        return $this->belongsTo(Lung::class);
    }
}
