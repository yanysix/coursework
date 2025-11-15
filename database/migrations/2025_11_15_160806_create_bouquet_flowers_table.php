<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bouquet_flowers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_bouquet_id')->constrained('bouquet')->onDelete('cascade');
            $table->foreignId('fk_flower_id')->constrained('flowers')->onDelete('cascade');
            $table->integer('count');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bouquet_flowers');
    }
};
