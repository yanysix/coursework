<?php

// app/Models/CartBouquet.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartBouquet extends Model
{
    protected $table = 'cart_bouquets';
    protected $fillable = ['fk_cart_id', 'fk_bouquet_id', 'price', 'count'];

    public function bouquet()
    {
        return $this->belongsTo(Bouquet::class, 'fk_bouquet_id');
    }
}

