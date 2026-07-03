@extends('layouts.admin')
@section('title', 'Laporan Peminjaman')
@section('content')
    @if (!$laporanTersedia)
        <div class="empty-state" data-aos="fade-up"><i class="bi bi-clipboard-data"></i>Laporan belum tersedia karena belum ada data peminjaman.</div>
    @else
        <div class="row g-3 mb-4">
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="0">
                <div class="card stat-card p-3"><div class="stat-value">{{ $totalPeminjaman }}</div><div class="stat-label">Total Peminjaman</div></div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="50">
                <div class="card stat-card p-3"><div class="stat-value">{{ $totalAktif }}</div><div class="stat-label">Sedang Dipinjam</div></div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="card stat-card stat-success p-3"><div class="stat-value">{{ $totalSelesai }}</div><div class="stat-label">Selesai</div></div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="150">
                <div class="card stat-card stat-danger p-3"><div class="stat-value">{{ $totalTerlambat }}</div><div class="stat-label">Terlambat</div></div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card stat-card p-3"><div class="stat-value">{{ $anggotaAktif }}</div><div class="stat-label">Anggota Aktif</div></div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="250">
                <div class="card stat-card p-3"><div class="stat-value">Rp{{ number_format($totalDenda, 0, ',', '.') }}</div><div class="stat-label">Total Denda Tercatat</div></div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card stat-card stat-danger p-3"><div class="stat-value">Rp{{ number_format($dendaBelumBayar, 0, ',', '.') }}</div><div class="stat-label">Denda Belum Dibayar</div></div>
            </div>
        </div>

        <h5 class="fw-bold" data-aos="fade-right">Buku Paling Sering Dipinjam</h5>
        <div class="table-responsive" data-aos="fade-up">
            <table class="table table-modern align-middle mb-0">
                <thead><tr><th>Judul Buku</th><th>Jumlah Dipinjam</th></tr></thead>
                <tbody>
                    @forelse ($bukuSeringDipinjam as $b)
                        <tr><td class="fw-semibold">{{ $b->buku->judul ?? '-' }}</td><td><span class="badge bg-primary-subtle text-primary">{{ $b->total }}x</span></td></tr>
                    @empty
                        <tr><td colspan="2"><div class="empty-state"><i class="bi bi-graph-down"></i>Belum ada data peminjaman.</div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
@endsection
