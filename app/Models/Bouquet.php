<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bouquet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'zodiac_sign'
    ];

    public function bouquets()
    {
        return $this->hasMany(CartBouquet::class, 'fk_cart_id');
    }
}
