<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartFlowers extends Model
{
    protected $table = 'cart_flowers';
    protected $fillable = ['fk_cart_id', 'fk_flower_id', 'price'];

    public function flower(): BelongsTo
    {
        return $this->belongsTo(Flower::class, 'fk_flower_id');
    }
}
