<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Perpustakaan')</title>
    @include('layouts.partials.head-assets')
</head>
<body>
    <div class="app-shell">
        <aside class="app-sidebar">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
                <span class="brand-mark">RL</span>
                <span>Ruang Baca<br>Lentera</span>
            </a>

            <span class="sidebar-role-pill" style="background:var(--tosca-dark);"><i class="bi bi-shield-lock-fill"></i> Admin</span>

            <nav class="side-menu">
                <a href="{{ route('admin.dashboard') }}" class="side-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="side-icon"><i class="bi bi-speedometer2"></i></span><span>Dashboard</span>
                </a>
                <a href="{{ route('admin.buku.index') }}" class="side-item {{ request()->routeIs('admin.buku.*') ? 'active' : '' }}">
                    <span class="side-icon"><i class="bi bi-book"></i></span><span>Data Buku</span>
                </a>
                <a href="{{ route('admin.kategori.index') }}" class="side-item {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                    <span class="side-icon"><i class="bi bi-tags"></i></span><span>Kategori</span>
                </a>
                <a href="{{ route('admin.anggota.index') }}" class="side-item {{ request()->routeIs('admin.anggota.*') ? 'active' : '' }}">
                    <span class="side-icon"><i class="bi bi-person-check"></i></span><span>Anggota</span>
                </a>
                <a href="{{ route('admin.peminjaman.index') }}" class="side-item {{ request()->routeIs('admin.peminjaman.*') ? 'active' : '' }}">
                    <span class="side-icon"><i class="bi bi-journal-arrow-up"></i></span><span>Peminjaman</span>
                </a>
                <a href="{{ route('admin.pengembalian.index') }}" class="side-item {{ request()->routeIs('admin.pengembalian.*') ? 'active' : '' }}">
                    <span class="side-icon"><i class="bi bi-journal-arrow-down"></i></span><span>Pengembalian</span>
                </a>
                <a href="{{ route('admin.laporan.index') }}" class="side-item {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                    <span class="side-icon"><i class="bi bi-bar-chart-line"></i></span><span>Laporan</span>
                </a>
            </nav>

            <div class="sidebar-foot">
                <strong>Panel Admin</strong>
                <p class="text-muted-soft">Kelola koleksi buku, verifikasi anggota, dan validasi transaksi peminjaman di sini.</p>
            </div>

            <form method="POST" action="{{ route('admin.logout') }}" class="sidebar-logout-form">
                @csrf
                <button type="submit"><i class="bi bi-box-arrow-right"></i> Logout</button>
            </form>
        </aside>

        <main class="app-main page-fade">
            <div class="app-topbar" data-aos="fade-down">
                <div>
                    <p class="eyebrow">Panel Pengelola</p>
                    <h3>@yield('title', 'Dashboard Admin')</h3>
                </div>
                <div class="topbar-user">
                    <div class="d-none d-sm-block text-end">
                        <div class="topbar-user-name">{{ auth('admin')->user()->nama_admin ?? 'Admin' }}</div>
                        <div class="topbar-user-role">Pengelola Perpustakaan</div>
                    </div>
                    <div class="topbar-avatar">{{ strtoupper(substr(auth('admin')->user()->nama_admin ?? 'A', 0, 1)) }}</div>
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
