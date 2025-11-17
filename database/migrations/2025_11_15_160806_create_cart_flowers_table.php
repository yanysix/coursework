<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cart_flowers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_cart_id')->constrained('cart')->onDelete('cascade');
            $table->foreignId('fk_flower_id')->constrained('flowers')->onDelete('cascade');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_flowers');
    }
};
