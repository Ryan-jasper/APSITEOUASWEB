<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id('buku_id');
            $table->foreignId('kategori_id')->constrained('kategori_bukus', 'kategori_id')->onDelete('cascade');
            $table->string('kode_buku', 30)->unique();
            $table->string('judul', 150);
            $table->string('penulis', 100);
            $table->string('penerbit', 100);
            $table->year('tahun_terbit')->nullable();
            $table->integer('stok')->default(0);
            $table->string('lokasi_rak', 50)->nullable();
            $table->enum('status_buku', ['available', 'unavailable'])->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
