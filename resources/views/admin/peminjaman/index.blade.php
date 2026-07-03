@extends('layouts.admin')
@section('title', 'Validasi Peminjaman')
@section('content')
    <div class="table-responsive" data-aos="fade-up">
        <table class="table table-modern align-middle mb-0">
            <thead><tr><th>Anggota</th><th>Buku</th><th>Tanggal Ajukan</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse ($peminjamans as $p)
                    <tr>
                        <td class="fw-semibold">{{ $p->anggota->nama_lengkap ?? '-' }}</td>
                        <td>
                            @foreach ($p->detail as $d)
                                <div>{{ $d->buku->judul ?? '-' }}</div>
                            @endforeach
                        </td>
                        <td>{{ $p->created_at->format('d-m-Y H:i') }}</td>
                        <td class="text-nowrap">
                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#detailPinjam{{ $p->peminjaman_id }}">
                                <i class="bi bi-eye"></i> Detail
                            </button>
                        </td>
                    </tr>

                    <!-- Modal detail pengajuan sesuai Use Case 5.4.15: lihat detail sebelum validasi -->
                    <div class="modal fade" id="detailPinjam{{ $p->peminjaman_id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content" style="border-radius:16px;">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold"><i class="bi bi-journal-text text-primary"></i> Detail Pengajuan Peminjaman</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-borderless mb-2">
                                        <tr><th width="140">Anggota</th><td>: {{ $p->anggota->nama_lengkap ?? '-' }}</td></tr>
                                        <tr><th>Email</th><td>: {{ $p->anggota->email ?? '-' }}</td></tr>
                                        <tr><th>Status Akun</th><td>: {{ $p->anggota->status_akun ?? '-' }}</td></tr>
                                        <tr><th>Tanggal Ajukan</th><td>: {{ $p->created_at->format('d-m-Y H:i') }}</td></tr>
                                    </table>
                                    <strong>Buku diajukan:</strong>
                                    <ul class="mb-0">
                                        @foreach ($p->detail as $d)
                                            <li>{{ $d->buku->judul ?? '-' }} &mdash; stok tersedia: <strong>{{ $d->buku->stok ?? 0 }}</strong></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="{{ route('admin.peminjaman.tolak', $p->peminjaman_id) }}">
                                        @csrf
                                        <button class="btn btn-outline-danger"><i class="bi bi-x-circle"></i>Tolak</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.peminjaman.setujui', $p->peminjaman_id) }}">
                                        @csrf
                                        <button class="btn btn-success"><i class="bi bi-check-circle"></i>Setujui</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr><td colspan="4"><div class="empty-state"><i class="bi bi-inbox"></i>Tidak ada pengajuan yang menunggu validasi.</div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
