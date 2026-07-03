@extends('layouts.admin')
@section('title', 'Catat Pengembalian')
@section('content')
    <p class="text-muted-soft mb-3" data-aos="fade-right"><i class="bi bi-info-circle text-primary"></i> Denda otomatis dihitung Rp5.000/hari jika melewati tanggal jatuh tempo.</p>

    <div class="table-responsive" data-aos="fade-up">
        <table class="table table-modern align-middle mb-0">
            <thead><tr><th>Anggota</th><th>Buku</th><th>Jatuh Tempo</th><th>Tanggal Pengembalian</th><th></th></tr></thead>
            <tbody>
                @forelse ($peminjamans as $p)
                    <tr>
                        <td class="fw-semibold">{{ $p->anggota->nama_lengkap ?? '-' }}</td>
                        <td>
                            @foreach ($p->detail as $d)
                                <div>{{ $d->buku->judul ?? '-' }}</div>
                            @endforeach
                        </td>
                        <td>{{ $p->tanggal_jatuh_tempo ? $p->tanggal_jatuh_tempo->format('d-m-Y') : '-' }}</td>
                        <td colspan="2">
                            <form method="POST" action="{{ route('admin.pengembalian.store', $p->peminjaman_id) }}" class="d-flex gap-2">
                                @csrf
                                <input type="date" name="tanggal_pengembalian" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                <button class="btn btn-sm btn-primary text-nowrap"><i class="bi bi-check2"></i>Catat</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5"><div class="empty-state"><i class="bi bi-inbox"></i>Tidak ada peminjaman aktif.</div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
