<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Packaging extends Model
{
    protected $table = 'packaging';

    public function bouquets(): HasMany
    {
        return $this->hasMany(Bouquet::class, 'fk_packing_id');
    }
}
