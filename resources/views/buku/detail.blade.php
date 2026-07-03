@extends('layouts.app')
@section('title', $buku->judul)
@section('content')
    <a href="{{ route('buku.index') }}" class="btn btn-link mb-3 ps-0"><i class="bi bi-arrow-left"></i> Kembali ke katalog</a>

    <div class="card card-hover p-4" data-aos="fade-up">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="book-cover detail-cover cover-a">
                    <span>{{ $buku->judul }}</span>
                    <small>{{ $buku->kategori->nama_kategori ?? 'Umum' }}</small>
                </div>
            </div>
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                    <h3 class="fw-bold mb-0">{{ $buku->judul }}</h3>
                    <span class="badge {{ $buku->status_buku == 'available' ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }} fs-6">
                        {{ $buku->status_buku == 'available' ? 'Tersedia' : 'Tidak Tersedia' }}
                    </span>
                </div>
                <p class="text-muted-soft mb-3">Ditulis oleh {{ $buku->penulis }}</p>

                <div class="info-grid">
                    <div class="info-item"><p><i class="bi bi-upc-scan"></i> Kode</p><strong>{{ $buku->kode_buku }}</strong></div>
                    <div class="info-item"><p><i class="bi bi-building"></i> Penerbit</p><strong>{{ $buku->penerbit }}</strong></div>
                    <div class="info-item"><p><i class="bi bi-calendar3"></i> Tahun Terbit</p><strong>{{ $buku->tahun_terbit }}</strong></div>
                    <div class="info-item"><p><i class="bi bi-tags"></i> Kategori</p><strong>{{ $buku->kategori->nama_kategori ?? '-' }}</strong></div>
                    <div class="info-item"><p><i class="bi bi-geo-alt"></i> Lokasi Rak</p><strong>{{ $buku->lokasi_rak }}</strong></div>
                    <div class="info-item"><p><i class="bi bi-box-seam"></i> Stok</p><strong>{{ $buku->stok }}</strong></div>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <form method="POST" action="{{ route('peminjaman.ajukan', $buku->buku_id) }}">
                        @csrf
                        <button class="btn btn-primary" @disabled($buku->stok < 1)><i class="bi bi-journal-plus"></i>Ajukan Peminjaman</button>
                    </form>
                    <form method="POST" action="{{ route('wishlist.store', $buku->buku_id) }}">
                        @csrf
                        <button class="btn btn-outline-danger"><i class="bi bi-heart"></i>Tambah ke Wishlist</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
