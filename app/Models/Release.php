<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Release extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'category_id',
        'description',
        'lung_id',
        'account_id',
        'value',
        'deposit'
    ];

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
}
