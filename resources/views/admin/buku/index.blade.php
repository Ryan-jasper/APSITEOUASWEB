@extends('layouts.admin')
@section('title', 'Data Buku')
@section('content')
    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap mb-3" data-aos="fade-right">
        <form method="GET" class="flex-grow-1" style="min-width:240px;max-width:420px;">
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" name="keyword" class="form-control" placeholder="Cari judul buku..." value="{{ request('keyword') }}">
            </div>
        </form>
        <a href="{{ route('admin.buku.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Tambah Buku</a>
    </div>

    <div class="table-responsive" data-aos="fade-up">
        <table class="table table-modern align-middle mb-0">
            <thead><tr><th>Kode</th><th>Judul</th><th>Penulis</th><th>Kategori</th><th>Stok</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse ($bukus as $b)
                    <tr>
                        <td>{{ $b->kode_buku }}</td>
                        <td class="fw-semibold">{{ $b->judul }}</td>
                        <td>{{ $b->penulis }}</td>
                        <td><span class="badge bg-primary-subtle text-primary">{{ $b->kategori->nama_kategori ?? '-' }}</span></td>
                        <td>{{ $b->stok }}</td>
                        <td>
                            <span class="badge {{ $b->status_buku == 'available' ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">
                                {{ $b->status_buku }}
                            </span>
                        </td>
                        <td class="text-nowrap">
                            <a href="{{ route('admin.buku.edit', $b->buku_id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.buku.destroy', $b->buku_id) }}" class="d-inline" onsubmit="return confirm('Yakin hapus buku ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7"><div class="empty-state"><i class="bi bi-journal-x"></i>Belum ada data buku.</div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $bukus->links() }}</div>
@endsection
