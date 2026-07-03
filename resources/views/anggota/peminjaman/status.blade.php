@extends('layouts.app')
@section('title', 'Status Peminjaman')
@section('content')
    <div class="table-responsive" data-aos="fade-up">
        <table class="table table-modern align-middle mb-0">
            <thead>
                <tr><th>Buku</th><th>Tanggal Pinjam</th><th>Jatuh Tempo</th><th>Status</th></tr>
            </thead>
            <tbody>
                @forelse ($peminjamans as $p)
                    <tr>
                        <td>
                            @foreach ($p->detail as $d)
                                <div><i class="bi bi-book text-primary"></i> {{ $d->buku->judul ?? '-' }}</div>
                            @endforeach
                        </td>
                        <td>{{ $p->tanggal_pinjam ? $p->tanggal_pinjam->format('d-m-Y') : '-' }}</td>
                        <td>{{ $p->tanggal_jatuh_tempo ? $p->tanggal_jatuh_tempo->format('d-m-Y') : '-' }}</td>
                        <td>
                            @switch($p->status_peminjaman)
                                @case('pending') <span class="badge bg-warning-subtle text-warning"><i class="bi bi-hourglass-split"></i> Menunggu Validasi</span> @break
                                @case('dipinjam') <span class="badge bg-primary-subtle text-primary"><i class="bi bi-book-half"></i> Sedang Dipinjam</span> @break
                                @case('selesai') <span class="badge bg-success-subtle text-success"><i class="bi bi-check-circle"></i> Selesai</span> @break
                                @case('ditolak') <span class="badge bg-danger-subtle text-danger"><i class="bi bi-x-circle"></i> Ditolak</span> @break
                            @endswitch
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4"><div class="empty-state"><i class="bi bi-inbox"></i>Belum ada data peminjaman.</div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
