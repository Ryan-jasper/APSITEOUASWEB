@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('content')
    <div class="welcome-banner" data-aos="fade-up">
        <h3 class="fw-bold mb-1">Halo, {{ auth('admin')->user()->nama_admin ?? 'Admin' }} 👋</h3>
        <p class="mb-0">Ringkasan aktivitas perpustakaan hari ini — pantau buku, anggota, dan transaksi dari sini.</p>
    </div>

    <div class="row g-3">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
            <div class="card stat-card p-3 d-flex flex-row align-items-center gap-3">
                <div class="stat-icon"><i class="bi bi-book"></i></div>
                <div><div class="stat-value" data-count="{{ $totalBuku }}">0</div><div class="stat-label">Total Buku</div></div>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="50">
            <div class="card stat-card stat-success p-3 d-flex flex-row align-items-center gap-3">
                <div class="stat-icon" style="background:var(--green-soft);color:var(--green);"><i class="bi bi-people"></i></div>
                <div><div class="stat-value" data-count="{{ $totalAnggota }}">0</div><div class="stat-label">Anggota Aktif</div></div>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card stat-card stat-warning p-3 d-flex flex-row align-items-center gap-3">
                <div class="stat-icon" style="background:var(--orange-soft);color:var(--orange);"><i class="bi bi-person-vcard"></i></div>
                <div><div class="stat-value" data-count="{{ $anggotaPending }}">0</div><div class="stat-label">Menunggu Verifikasi</div></div>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="150">
            <div class="card stat-card stat-warning p-3 d-flex flex-row align-items-center gap-3">
                <div class="stat-icon" style="background:var(--orange-soft);color:var(--orange);"><i class="bi bi-journal-arrow-up"></i></div>
                <div><div class="stat-value" data-count="{{ $peminjamanPending }}">0</div><div class="stat-label">Menunggu Validasi</div></div>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card stat-card p-3 d-flex flex-row align-items-center gap-3">
                <div class="stat-icon"><i class="bi bi-book-half"></i></div>
                <div><div class="stat-value" data-count="{{ $peminjamanAktif }}">0</div><div class="stat-label">Peminjaman Aktif</div></div>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="250">
            <div class="card stat-card stat-danger p-3 d-flex flex-row align-items-center gap-3">
                <div class="stat-icon" style="background:var(--red-soft);color:var(--red);"><i class="bi bi-cash-coin"></i></div>
                <div><div class="stat-value" data-count="{{ $dendaBelumBayar }}" data-prefix="Rp">Rp0</div><div class="stat-label">Denda Belum Dibayar</div></div>
            </div>
        </div>
    </div>
@endsection
