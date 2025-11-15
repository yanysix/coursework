<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Model
{
    protected $table = 'cards';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'fk_user_id');
    }
}

