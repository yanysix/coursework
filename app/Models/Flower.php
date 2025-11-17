<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Flower extends Model
{
    // Таблица в базе
    protected $table = 'flowers';

    // Разрешенные для массового заполнения поля
    protected $fillable = ['name', 'price', 'image'];

    /**
     * Связь многие-ко-многим с букетами
     */
    public function bouquets(): BelongsToMany
    {
        return $this->belongsToMany(
            Cart::class,
            'bouquet_flowers',
            'fk_flower_id',
            'fk_bouquet_id'
        )->withPivot('count');
    }

    /**
     * Получить полный URL изображения
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? Storage::url($this->image) : null;
    }
}
