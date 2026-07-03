@extends('layouts.app')
@section('title', 'Cari Buku')
@section('content')
    <p class="text-muted-soft mb-3" data-aos="fade-right">Telusuri koleksi, cek ketersediaan stok, lalu ajukan peminjaman langsung dari sini.</p>

    <form method="GET" action="{{ route('buku.index') }}" class="row g-2 mb-4" data-aos="fade-up">
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" name="keyword" class="form-control" placeholder="Cari judul / pengarang / kode buku..." value="{{ request('keyword') }}">
            </div>
        </div>
        <div class="col-md-4">
            <select name="kategori_id" class="form-select">
                <option value="">Semua Kategori</option>
                @foreach ($kategoris as $k)
                    <option value="{{ $k->kategori_id }}" @selected(request('kategori_id') == $k->kategori_id)>{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100"><i class="bi bi-funnel"></i>Cari</button>
        </div>
    </form>

    @php $covers = ['cover-a', 'cover-b', 'cover-c', 'cover-d', 'cover-e', 'cover-f']; @endphp

    <div class="row g-3">
        @forelse ($bukus as $i => $buku)
            <div class="col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ min($i * 50, 300) }}">
                <div class="card card-hover h-100 p-3">
                    <div class="book-cover {{ $covers[$i % count($covers)] }} mb-3">
                        <span>{{ $buku->judul }}</span>
                        <small>{{ $buku->kategori->nama_kategori ?? 'Umum' }}</small>
                    </div>
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge {{ $buku->status_buku == 'available' ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">
                            {{ $buku->status_buku == 'available' ? 'Tersedia' : 'Tidak Tersedia' }}
                        </span>
                    </div>
                    <p class="fw-bold mb-1">{{ $buku->judul }}</p>
                    <p class="text-muted-soft small mb-1"><i class="bi bi-person"></i> {{ $buku->penulis }}</p>
                    <p class="text-muted-soft small mb-3"><i class="bi bi-box-seam"></i> Stok: {{ $buku->stok }}</p>
                    <div class="d-flex gap-2 mt-auto">
                        <a href="{{ route('buku.show', $buku->buku_id) }}" class="btn btn-sm btn-primary flex-grow-1"><i class="bi bi-eye"></i>Detail</a>
                        <form method="POST" action="{{ route('wishlist.store', $buku->buku_id) }}">
                            @csrf
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-heart"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state"><i class="bi bi-journal-x"></i>Buku tidak ditemukan.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $bukus->links() }}
    </div>
@endsection
