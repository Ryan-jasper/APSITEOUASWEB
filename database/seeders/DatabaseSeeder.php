<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin default (idempotent supaya aman kalau seeder jalan ulang)
        Admin::firstOrCreate(
            ['username' => 'admin'],
            [
                'nama_admin' => 'Administrator',
                'email' => 'admin@perpustakaan.test',
                'password_hash' => Hash::make('admin123'),
            ]
        );

        // Akun anggota contoh (langsung aktif untuk testing)
        Anggota::firstOrCreate(
            ['username' => 'anggota'],
            [
                'nama_lengkap' => 'Anggota Contoh',
                'email' => 'anggota@perpustakaan.test',
                'password_hash' => Hash::make('anggota123'),
                'alamat' => 'Surabaya',
                'no_telp' => '081234567890',
                'status_akun' => 'active',
                'tanggal_daftar' => now(),
            ]
        );

        // Kategori contoh
        $fiksi = KategoriBuku::firstOrCreate(['nama_kategori' => 'Fiksi'], ['deskripsi' => 'Buku fiksi dan novel']);
        $nonfiksi = KategoriBuku::firstOrCreate(['nama_kategori' => 'Non-Fiksi'], ['deskripsi' => 'Buku pengetahuan umum']);
        $teknologi = KategoriBuku::firstOrCreate(['nama_kategori' => 'Teknologi'], ['deskripsi' => 'Buku komputer & teknologi']);

        // Buku contoh
        Buku::firstOrCreate(
            ['kode_buku' => 'FIK-001'],
            [
                'kategori_id' => $fiksi->kategori_id,
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => 2005,
                'stok' => 3,
                'lokasi_rak' => 'A1',
                'status_buku' => 'available',
            ]
        );

        Buku::firstOrCreate(
            ['kode_buku' => 'TEK-001'],
            [
                'kategori_id' => $teknologi->kategori_id,
                'judul' => 'Belajar Laravel Dasar',
                'penulis' => 'Budi Santoso',
                'penerbit' => 'Elex Media',
                'tahun_terbit' => 2022,
                'stok' => 5,
                'lokasi_rak' => 'B2',
                'status_buku' => 'available',
            ]
        );

        Buku::firstOrCreate(
            ['kode_buku' => 'NF-001'],
            [
                'kategori_id' => $nonfiksi->kategori_id,
                'judul' => 'Sapiens: Riwayat Singkat Umat Manusia',
                'penulis' => 'Yuval Noah Harari',
                'penerbit' => 'KPG',
                'tahun_terbit' => 2017,
                'stok' => 2,
                'lokasi_rak' => 'C1',
                'status_buku' => 'available',
            ]
        );
    }
}
