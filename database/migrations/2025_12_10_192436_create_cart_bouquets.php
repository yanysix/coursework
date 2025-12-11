<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_bouquets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_cart_id')->constrained('cart')->onDelete('cascade');
            $table->foreignId('fk_bouquet_id')->constrained('bouquets')->onDelete('cascade');
            $table->decimal('price', 8, 2);
            $table->integer('count')->default(1);;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_bouquets');
    }
};
