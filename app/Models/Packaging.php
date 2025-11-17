<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Packaging extends Model
{
    protected $table = 'packaging';

    protected $fillable = ['name', 'price', 'image', 'zodiac_sign'];

    public function bouquets(): HasMany
    {
        return $this->hasMany(Cart::class, 'fk_packing_id');
    }
}
