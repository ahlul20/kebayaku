<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kebayas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category', 30)->index();
            $table->json('sizes');                          // ["S","M","L"]
            $table->string('color', 50);
            $table->string('material', 80)->nullable();
            $table->unsignedInteger('price');               // harga sewa per 3 hari (Rupiah)
            $table->text('description')->nullable();
            $table->foreignId('image_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->string('image_path')->nullable();       // gambar bawaan di public/ (data awal)
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kebayas');
    }
};
