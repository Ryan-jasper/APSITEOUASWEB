<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_peminjaman', function (Blueprint $table) {
            $table->id('detail_id');
            $table->foreignId('peminjaman_id')->constrained('peminjaman', 'peminjaman_id')->onDelete('cascade');
            $table->foreignId('buku_id')->constrained('bukus', 'buku_id')->onDelete('cascade');
            $table->integer('jumlah')->default(1);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_peminjaman');
    }
};
