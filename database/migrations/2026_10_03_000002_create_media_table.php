<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Gambar disimpan langsung di database (base64) karena filesystem
 * container Vercel tidak permanen — file upload biasa akan hilang.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('mime', 50);
            $table->unsignedInteger('size');
            $table->longText('data');                 // base64
            $table->boolean('is_private')->default(false); // KTP & bukti bayar: hanya admin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
