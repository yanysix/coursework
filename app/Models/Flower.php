<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Flower extends Model
{
    protected $table = 'flowers';

    protected $fillable = ['name', 'price', 'image', 'zodiac_sign'];


    public function bouquets(): BelongsToMany
    {
        return $this->belongsToMany(
            Cart::class,
            'bouquet_flowers',
            'fk_flower_id',
            'fk_bouquet_id'
        )->withPivot('count');
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? Storage::url($this->image) : null;
    }
}
