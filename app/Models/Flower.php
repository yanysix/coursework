<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Flower extends Model
{
    protected $table = 'flowers';

    public function bouquets(): BelongsToMany
    {
        return $this->belongsToMany(
            Bouquet::class,
            'bouquet_flowers',
            'fk_flower_id',
            'fk_bouquet_id'
        )->withPivot('count');
    }
}
