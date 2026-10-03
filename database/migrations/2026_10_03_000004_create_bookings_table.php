<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id', 20)->unique();
            $table->foreignId('kebaya_id')->constrained()->restrictOnDelete();

            // Data pelanggan
            $table->string('customer_name', 100);
            $table->string('whatsapp', 20);
            $table->string('email', 150)->nullable();

            // Detail sewa
            $table->string('size', 10);
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedSmallInteger('duration_days');
            $table->unsignedInteger('rent_price');
            $table->unsignedInteger('deposit');
            $table->unsignedInteger('total_price');

            // Pengiriman
            $table->string('delivery_type', 20);            // Kirim | Ambil
            $table->text('address')->nullable();
            $table->text('notes')->nullable();

            // Dokumen (privat)
            $table->foreignId('ktp_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->foreignId('proof_media_id')->nullable()->constrained('media')->nullOnDelete();

            $table->string('status', 30)->default('Menunggu Verifikasi')->index();
            $table->timestamps();

            $table->index(['kebaya_id', 'start_date', 'end_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
