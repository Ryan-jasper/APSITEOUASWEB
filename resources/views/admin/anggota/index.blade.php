@extends('layouts.admin')
@section('title', 'Verifikasi Anggota')
@section('content')
    <ul class="nav nav-pills mb-3" data-aos="fade-up">
        <li class="nav-item">
            <a class="nav-link {{ $filter == 'pending' ? 'active' : '' }}" href="{{ route('admin.anggota.index', ['status' => 'pending']) }}">
                Menunggu Verifikasi @if($jumlahPending > 0)<span class="badge bg-danger ms-1">{{ $jumlahPending }}</span>@endif
            </a>
        </li>
        <li class="nav-item"><a class="nav-link {{ $filter == 'active' ? 'active' : '' }}" href="{{ route('admin.anggota.index', ['status' => 'active']) }}">Aktif</a></li>
        <li class="nav-item"><a class="nav-link {{ $filter == 'inactive' ? 'active' : '' }}" href="{{ route('admin.anggota.index', ['status' => 'inactive']) }}">Ditolak</a></li>
        <li class="nav-item"><a class="nav-link {{ $filter == 'all' ? 'active' : '' }}" href="{{ route('admin.anggota.index', ['status' => 'all']) }}">Semua</a></li>
    </ul>

    <div class="table-responsive" data-aos="fade-up">
        <table class="table table-modern align-middle mb-0">
            <thead><tr><th>Nama</th><th>Username</th><th>Email</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse ($anggotas as $a)
                    <tr>
                        <td class="fw-semibold">{{ $a->nama_lengkap }}</td>
                        <td>{{ $a->username }}</td>
                        <td>{{ $a->email }}</td>
                        <td>
                            @switch($a->status_akun)
                                @case('pending') <span class="badge bg-warning-subtle text-warning">Menunggu</span> @break
                                @case('active') <span class="badge bg-success-subtle text-success">Aktif</span> @break
                                @case('inactive') <span class="badge bg-danger-subtle text-danger">Ditolak/Nonaktif</span> @break
                            @endswitch
                        </td>
                        <td class="text-nowrap">
                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#detailAnggota{{ $a->anggota_id }}">
                                <i class="bi bi-eye"></i> Detail
                            </button>
                        </td>
                    </tr>

                    <!-- Modal detail sesuai Use Case: admin lihat detail registrasi sebelum putuskan -->
                    <div class="modal fade" id="detailAnggota{{ $a->anggota_id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content" style="border-radius:16px;">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold"><i class="bi bi-person-vcard text-primary"></i> Detail Registrasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-borderless mb-0">
                                        <tr><th width="140">Nama</th><td>: {{ $a->nama_lengkap }}</td></tr>
                                        <tr><th>Username</th><td>: {{ $a->username }}</td></tr>
                                        <tr><th>Email</th><td>: {{ $a->email }}</td></tr>
                                        <tr><th>No. Telp</th><td>: {{ $a->no_telp ?? '-' }}</td></tr>
                                        <tr><th>Alamat</th><td>: {{ $a->alamat ?? '-' }}</td></tr>
                                        <tr><th>Tgl Daftar</th><td>: {{ $a->tanggal_daftar ? $a->tanggal_daftar->format('d-m-Y') : '-' }}</td></tr>
                                    </table>
                                </div>
                                @if ($a->status_akun == 'pending')
                                    <div class="modal-footer">
                                        <form method="POST" action="{{ route('admin.anggota.tolak', $a->anggota_id) }}">
                                            @csrf
                                            <button class="btn btn-outline-danger"><i class="bi bi-x-circle"></i>Tolak</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.anggota.verifikasi', $a->anggota_id) }}">
                                            @csrf
                                            <button class="btn btn-success"><i class="bi bi-check-circle"></i>Verifikasi</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <tr><td colspan="5"><div class="empty-state"><i class="bi bi-person-check"></i>Tidak ada data anggota pada kategori ini.</div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $anggotas->links() }}</div>
@endsection
