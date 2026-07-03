@extends('layouts.app')
@section('title', 'Notifikasi')
@section('content')
    <p class="text-muted-soft mb-3" data-aos="fade-right">Pemberitahuan terbaru seputar peminjaman, validasi, dan denda kamu.</p>

    <div class="card p-3" data-aos="fade-up">
        @forelse ($notifikasis as $n)
            <div class="notify-row">
                <div class="icon-box"><i class="bi bi-bell-fill"></i></div>
                <div>
                    <div>{{ $n->pesan }}</div>
                    <small class="text-muted-soft">{{ $n->created_at->format('d-m-Y H:i') }}</small>
                </div>
            </div>
        @empty
            <div class="empty-state"><i class="bi bi-bell-slash"></i>Belum ada notifikasi.</div>
        @endforelse
    </div>
@endsection
