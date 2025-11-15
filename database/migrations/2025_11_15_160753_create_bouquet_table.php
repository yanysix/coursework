<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bouquet', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('fk_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('fk_packing_id')->constrained('packaging')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bouquet');
    }
};
