<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Anggota</title>
    @include('layouts.partials.head-assets')
</head>
<body>
    <div class="container-fluid auth-wrapper">
        <div class="row min-vh-100">
            <div class="col-lg-5 d-flex align-items-center justify-content-center auth-panel py-5 order-2 order-lg-1">
                <div class="deco-circle" style="width:220px;height:220px;top:-60px;left:-60px;"></div>
                <div class="deco-circle" style="width:160px;height:160px;bottom:-40px;right:-40px;"></div>
                <div class="text-center px-4" data-aos="fade-right" style="position:relative;">
                    <i class="bi bi-book-half" style="font-size:5rem; color: var(--yellow);"></i>
                    <h3 class="fw-bold mt-3">Selamat Datang Kembali</h3>
                    <p style="opacity:.9;">Masuk untuk mencari buku, mengajukan peminjaman, dan memantau status pinjamanmu.</p>
                    <div class="auth-illustration justify-content-center">
                        <div class="spine"></div>
                        <div class="spine"></div>
                        <div class="spine"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-flex align-items-center justify-content-center py-5 order-1 order-lg-2">
                <div class="w-100 px-4" style="max-width: 420px;" data-aos="fade-left">
                    <h4 class="fw-bold mb-1"><i class="bi bi-box-arrow-in-right text-primary"></i> Login Anggota</h4>
                    <p class="text-muted-soft mb-4">Masukkan akun kamu untuk melanjutkan</p>

                    @include('layouts.partials.flash')

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" name="login" id="login" class="form-control" placeholder="Username/Email" value="{{ old('login') }}" required autofocus>
                            <label for="login">Username atau Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>
                        <button class="btn btn-primary w-100 py-2"><i class="bi bi-box-arrow-in-right"></i>Masuk</button>
                    </form>

                    <p class="text-center mt-4 mb-0">Belum punya akun? <a href="{{ route('register') }}" class="fw-semibold">Daftar di sini</a></p>
                    <p class="text-center mt-1"><a href="{{ route('admin.login') }}" class="text-muted-soft"><i class="bi bi-shield-lock"></i> Login sebagai Admin</a></p>
                    <p class="text-center mt-2"><a href="{{ url('/') }}" class="text-muted-soft small"><i class="bi bi-arrow-left"></i> Kembali ke beranda</a></p>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.partials.foot-assets')
</body>
</html>
