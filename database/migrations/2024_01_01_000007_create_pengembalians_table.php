<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id('pengembalian_id');
            $table->foreignId('peminjaman_id')->constrained('peminjaman', 'peminjaman_id')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->constrained('admins', 'admin_id')->onDelete('set null');
            $table->date('tanggal_pengembalian');
            $table->enum('status_pengembalian', ['tepat_waktu', 'terlambat']);
            $table->integer('total_terlambat')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};
