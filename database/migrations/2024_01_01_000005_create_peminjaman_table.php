<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('peminjaman_id');
            $table->foreignId('anggota_id')->constrained('anggotas', 'anggota_id')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->constrained('admins', 'admin_id')->onDelete('set null');
            $table->date('tanggal_pinjam')->nullable();
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->enum('status_peminjaman', ['pending', 'dipinjam', 'selesai', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
