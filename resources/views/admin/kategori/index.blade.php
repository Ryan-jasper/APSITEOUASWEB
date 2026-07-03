@extends('layouts.admin')
@section('title', 'Kategori Buku')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3" data-aos="fade-right">
        <p class="text-muted-soft mb-0">Kelola kelompok koleksi buku perpustakaan.</p>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Tambah Kategori</a>
    </div>

    <div class="table-responsive" data-aos="fade-up">
        <table class="table table-modern align-middle mb-0">
            <thead><tr><th>Nama Kategori</th><th>Deskripsi</th><th>Jumlah Buku</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse ($kategoris as $k)
                    <tr>
                        <td class="fw-semibold">{{ $k->nama_kategori }}</td>
                        <td>{{ $k->deskripsi }}</td>
                        <td><span class="badge bg-primary-subtle text-primary">{{ $k->buku_count }}</span></td>
                        <td class="text-nowrap">
                            <a href="{{ route('admin.kategori.edit', $k->kategori_id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.kategori.destroy', $k->kategori_id) }}" class="d-inline" onsubmit="return confirm('Yakin hapus kategori ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4"><div class="empty-state"><i class="bi bi-tags"></i>Belum ada kategori.</div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
