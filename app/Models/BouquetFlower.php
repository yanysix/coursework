<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BouquetFlower extends Pivot
{
    protected $table = 'bouquet_flowers';

    protected $fillable = ['fk_bouquet_id', 'fk_flower_id', 'count'];
}
