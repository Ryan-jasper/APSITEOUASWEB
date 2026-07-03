<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan Online</title>
    @include('layouts.partials.head-assets')
</head>
<body>
    <section class="hero-section py-5">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-7" data-aos="fade-right">
                    <span class="hero-badge mb-3"><i class="bi bi-mortarboard-fill"></i> Kelompok 22 &mdash; SI Universitas Airlangga</span>
                    <h1 class="display-5 fw-bold mt-3 mb-3">Sistem Informasi Peminjaman Buku Perpustakaan</h1>
                    <p class="fs-5 mb-4" style="opacity:.9;">Cari, pinjam, dan pantau buku perpustakaan secara online — proses pendaftaran, peminjaman, pengembalian, hingga denda kini terpusat dan mudah dilacak.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('login') }}" class="btn btn-light btn-lg fw-semibold text-primary"><i class="bi bi-box-arrow-in-right"></i>Login Anggota</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg fw-semibold"><i class="bi bi-person-plus"></i>Daftar Akun</a>
                        <a href="{{ route('admin.login') }}" class="btn btn-outline-light btn-lg fw-semibold"><i class="bi bi-shield-lock"></i>Login Admin</a>
                    </div>
                </div>
                <div class="col-lg-5 text-center" data-aos="fade-left">
                    <i class="bi bi-book-half hero-book" style="font-size: 10rem; opacity:.95;"></i>
                    <div class="auth-illustration justify-content-center mt-3">
                        <div class="spine"></div>
                        <div class="spine"></div>
                        <div class="spine"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Kenapa Sistem Ini?</h2>
            <p class="text-muted-soft">Menggantikan pencatatan manual dengan alur digital yang terstruktur</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                <div class="card h-100 card-hover p-4">
                    <div class="feature-icon mb-3"><i class="bi bi-search"></i></div>
                    <h5 class="fw-bold">Cari & Pinjam Online</h5>
                    <p class="text-muted-soft mb-0">Cari katalog buku, cek stok, dan ajukan peminjaman tanpa harus ke rak fisik dulu.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 card-hover p-4">
                    <div class="feature-icon mb-3"><i class="bi bi-clock-history"></i></div>
                    <h5 class="fw-bold">Pantau Status Real-time</h5>
                    <p class="text-muted-soft mb-0">Lihat status validasi, jatuh tempo, riwayat peminjaman, dan info denda kapan saja.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 card-hover p-4">
                    <div class="feature-icon mb-3"><i class="bi bi-graph-up-arrow"></i></div>
                    <h5 class="fw-bold">Laporan Terpusat</h5>
                    <p class="text-muted-soft mb-0">Admin dapat memantau statistik peminjaman, keterlambatan, dan denda secara ringkas.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-center text-muted-soft py-4 border-top">
        &copy; {{ date('Y') }} Sistem Informasi Peminjaman Buku Perpustakaan &mdash; Kelompok 22
    </footer>

    @include('layouts.partials.foot-assets')
</body>
</html>
