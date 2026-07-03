@extends('layouts.app')
@section('title', 'Riwayat Peminjaman')
@section('content')
    <div class="table-responsive" data-aos="fade-up">
        <table class="table table-modern align-middle mb-0">
            <thead>
                <tr><th>Buku</th><th>Tanggal Pinjam</th><th>Jatuh Tempo</th><th>Status</th><th>Denda</th></tr>
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
                                @case('pending') <span class="badge bg-warning-subtle text-warning">Menunggu</span> @break
                                @case('dipinjam') <span class="badge bg-primary-subtle text-primary">Dipinjam</span> @break
                                @case('selesai') <span class="badge bg-success-subtle text-success">Selesai</span> @break
                                @case('ditolak') <span class="badge bg-danger-subtle text-danger">Ditolak</span> @break
                            @endswitch
                        </td>
                        <td>
                            @if ($p->pengembalian && $p->pengembalian->denda)
                                <span class="fw-semibold text-danger">Rp{{ number_format($p->pengembalian->denda->total_denda, 0, ',', '.') }}</span>
                                <div class="small text-muted-soft">{{ $p->pengembalian->denda->status_bayar == 'sudah_bayar' ? 'Lunas' : 'Belum Lunas' }}</div>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5"><div class="empty-state"><i class="bi bi-inbox"></i>Belum ada riwayat peminjaman.</div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
