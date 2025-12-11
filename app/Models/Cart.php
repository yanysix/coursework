<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $table = 'cart';

    protected $fillable = [
        'fk_user_id',
        'total_amount'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'fk_user_id');
    }

    public function flowers(): HasMany
    {
        return $this->hasMany(CartFlowers::class, 'fk_cart_id');
    }

    public function packagings(): HasMany
    {
        return $this->hasMany(CartPackagings::class, 'fk_cart_id');
    }

    public function bouquets()
    {
        return $this->hasMany(CartBouquet::class, 'fk_cart_id');
    }
}
