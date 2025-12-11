<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartPackagings extends Model
{
    protected $table = 'cart_packagings';
    protected $fillable = ['fk_cart_id', 'fk_packaging_id', 'price', 'count'];

    public function packaging(): BelongsTo
    {
        return $this->belongsTo(Packaging::class, 'fk_packaging_id');
    }
}
