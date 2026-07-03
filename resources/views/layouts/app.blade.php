<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Perpustakaan Online')</title>
    @include('layouts.partials.head-assets')
</head>
<body>
    <div class="app-shell">
        <aside class="app-sidebar">
            <a href="{{ route('dashboard') }}" class="sidebar-brand">
                <span class="brand-mark">RL</span>
                <span>Ruang Baca<br>Lentera</span>
            </a>

            <span class="sidebar-role-pill"><i class="bi bi-person-fill"></i> Anggota</span>

            <nav class="side-menu">
                <a href="{{ route('dashboard') }}" class="side-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="side-icon"><i class="bi bi-speedometer2"></i></span><span>Dashboard</span>
                </a>
                <a href="{{ route('buku.index') }}" class="side-item {{ request()->routeIs('buku.*') ? 'active' : '' }}">
                    <span class="side-icon"><i class="bi bi-search"></i></span><span>Cari Buku</span>
                </a>
                <a href="{{ route('peminjaman.status') }}" class="side-item {{ request()->routeIs('peminjaman.status') ? 'active' : '' }}">
                    <span class="side-icon"><i class="bi bi-journal-check"></i></span><span>Status</span>
                </a>
                <a href="{{ route('peminjaman.riwayat') }}" class="side-item {{ request()->routeIs('peminjaman.riwayat') ? 'active' : '' }}">
                    <span class="side-icon"><i class="bi bi-clock-history"></i></span><span>Riwayat</span>
                </a>
                <a href="{{ route('denda.index') }}" class="side-item {{ request()->routeIs('denda.index') ? 'active' : '' }}">
                    <span class="side-icon"><i class="bi bi-cash-coin"></i></span><span>Denda</span>
                </a>
                <a href="{{ route('wishlist.index') }}" class="side-item {{ request()->routeIs('wishlist.index') ? 'active' : '' }}">
                    <span class="side-icon"><i class="bi bi-heart"></i></span><span>Wishlist</span>
                </a>
                <a href="{{ route('notifikasi.index') }}" class="side-item {{ request()->routeIs('notifikasi.index') ? 'active' : '' }}">
                    <span class="side-icon"><i class="bi bi-bell"></i></span><span>Notifikasi</span>
                </a>
            </nav>

            <div class="sidebar-foot">
                <strong>Butuh bantuan?</strong>
                <p class="text-muted-soft">Ajukan peminjaman lewat katalog, Admin akan memvalidasi sebelum buku bisa diambil.</p>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="sidebar-logout-form">
                @csrf
                <button type="submit"><i class="bi bi-box-arrow-right"></i> Logout</button>
            </form>
        </aside>

        <main class="app-main page-fade">
            <div class="app-topbar" data-aos="fade-down">
                <div>
                    <p class="eyebrow">Ruang Baca Lentera</p>
                    <h3>@yield('title', 'Dashboard')</h3>
                </div>
                <div class="topbar-user">
                    <div class="d-none d-sm-block text-end">
                        <div class="topbar-user-name">{{ auth('anggota')->user()->nama_lengkap ?? 'Anggota' }}</div>
                        <div class="topbar-user-role">Anggota Perpustakaan</div>
                    </div>
                    <div class="topbar-avatar">{{ strtoupper(substr(auth('anggota')->user()->nama_lengkap ?? 'A', 0, 1)) }}</div>
                </div>
            </div>

            @include('layouts.partials.flash')
            @yield('content')
        </main>
    </div>

    @include('layouts.partials.foot-assets')
    @stack('scripts')
</body>
</html>
