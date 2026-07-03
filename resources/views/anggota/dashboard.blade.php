@extends('layouts.app')
@section('title', 'Dashboard Anggota')
@section('content')
    <div class="welcome-banner" data-aos="fade-up">
        <h3 class="fw-bold mb-1">Halo, {{ auth('anggota')->user()->nama_lengkap }} 👋</h3>
        <p class="mb-0">Selamat datang di Ruang Baca Lentera. Cari buku, ajukan peminjaman, dan pantau statusnya di sini.</p>
    </div>

    <div class="row g-3">
        <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="0">
            <a href="{{ route('buku.index') }}" class="quick-link-card">
                <div class="card card-hover h-100"><div class="quick-icon"><i class="bi bi-search"></i></div><div class="fw-semibold">Cari Buku</div></div>
            </a>
        </div>
        <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="50">
            <a href="{{ route('peminjaman.status') }}" class="quick-link-card">
                <div class="card card-hover h-100"><div class="quick-icon"><i class="bi bi-journal-check"></i></div><div class="fw-semibold">Status Peminjaman</div></div>
            </a>
        </div>
        <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
            <a href="{{ route('denda.index') }}" class="quick-link-card">
                <div class="card card-hover h-100"><div class="quick-icon"><i class="bi bi-cash-coin"></i></div><div class="fw-semibold">Info Denda</div></div>
            </a>
        </div>
        <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="150">
            <a href="{{ route('wishlist.index') }}" class="quick-link-card">
                <div class="card card-hover h-100"><div class="quick-icon"><i class="bi bi-heart"></i></div><div class="fw-semibold">Wishlist</div></div>
            </a>
        </div>
    </div>
@endsection
