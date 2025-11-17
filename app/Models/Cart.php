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

    /**
     * Связь с пользователем
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'fk_user_id');
    }

    /**
     * Связь с цветами в корзине
     */
    public function flowers(): HasMany
    {
        return $this->hasMany(CartFlowers::class, 'fk_cart_id');
    }

    /**
     * Связь с упаковками в корзине
     */
    public function packagings(): HasMany
    {
        return $this->hasMany(CartPackagings::class, 'fk_cart_id');
    }
}
