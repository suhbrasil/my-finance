<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lung extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function releases(): HasMany
    {
        return $this->hasMany(Release::class);
    }

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }
}
