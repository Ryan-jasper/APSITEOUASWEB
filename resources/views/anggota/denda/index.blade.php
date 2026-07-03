@extends('layouts.app')
@section('title', 'Informasi Denda')
@section('content')
    <div class="table-responsive" data-aos="fade-up">
        <table class="table table-modern align-middle mb-0">
            <thead>
                <tr><th>Buku</th><th>Hari Terlambat</th><th>Tarif/Hari</th><th>Total Denda</th><th>Status</th></tr>
            </thead>
            <tbody>
                @forelse ($dendas as $d)
                    <tr>
                        <td>
                            @foreach ($d->pengembalian->peminjaman->detail as $det)
                                <div><i class="bi bi-book text-primary"></i> {{ $det->buku->judul ?? '-' }}</div>
                            @endforeach
                        </td>
                        <td>{{ $d->jumlah_hari_terlambat }} hari</td>
                        <td>Rp{{ number_format($d->tarif_per_hari, 0, ',', '.') }}</td>
                        <td class="fw-semibold">Rp{{ number_format($d->total_denda, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge {{ $d->status_bayar == 'sudah_bayar' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                                {{ $d->status_bayar == 'sudah_bayar' ? 'Sudah Bayar' : 'Belum Bayar' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5"><div class="empty-state"><i class="bi bi-emoji-smile"></i>Kamu tidak memiliki denda. Selalu tepat waktu! 🎉</div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
