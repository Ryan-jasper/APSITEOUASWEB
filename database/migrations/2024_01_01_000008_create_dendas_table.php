<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dendas', function (Blueprint $table) {
            $table->id('denda_id');
            $table->foreignId('pengembalian_id')->constrained('pengembalians', 'pengembalian_id')->onDelete('cascade');
            $table->integer('jumlah_hari_terlambat');
            $table->decimal('tarif_per_hari', 10, 2)->default(5000);
            $table->decimal('total_denda', 10, 2);
            $table->enum('status_bayar', ['belum_bayar', 'sudah_bayar'])->default('belum_bayar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dendas');
    }
};
