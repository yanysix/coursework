<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bouquet extends Model
{
    protected $table = 'bouquet';

    public function packaging(): BelongsTo
    {
        return $this->belongsTo(Packaging::class, 'fk_packing_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'fk_user_id');
    }

    public function flowers(): BelongsToMany
    {
        return $this->belongsToMany(
            Flower::class,
            'bouquet_flowers',
            'fk_bouquet_id',
            'fk_flower_id'
        )->withPivot('count');
    }
}
