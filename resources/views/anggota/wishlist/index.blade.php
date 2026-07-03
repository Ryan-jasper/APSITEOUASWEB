@extends('layouts.app')
@section('title', 'Wishlist')
@section('content')
    <p class="text-muted-soft mb-3" data-aos="fade-right">Buku favorit yang kamu simpan untuk dipinjam nanti.</p>

    @php $covers = ['cover-b', 'cover-d', 'cover-c', 'cover-a', 'cover-e', 'cover-f']; @endphp

    <div class="row g-3">
        @forelse ($wishlists as $i => $w)
            <div class="col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ min($i * 50, 300) }}">
                <div class="card card-hover h-100 p-3">
                    <div class="book-cover {{ $covers[$i % count($covers)] }} mb-3">
                        <span>{{ $w->buku->judul ?? '-' }}</span>
                        <small>{{ $w->buku->kategori->nama_kategori ?? 'Umum' }}</small>
                    </div>
                    <p class="fw-bold mb-1">{{ $w->buku->judul ?? '-' }}</p>
                    <p class="text-muted-soft small mb-3"><i class="bi bi-person"></i> {{ $w->buku->penulis ?? '-' }}</p>
                    <div class="d-flex justify-content-between gap-2 mt-auto">
                        <a href="{{ route('buku.show', $w->buku_id) }}" class="btn btn-sm btn-primary flex-grow-1"><i class="bi bi-eye"></i>Detail</a>
                        <form method="POST" action="{{ route('wishlist.destroy', $w->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12"><div class="empty-state"><i class="bi bi-heart"></i>Wishlist kamu masih kosong.</div></div>
        @endforelse
    </div>
@endsection
