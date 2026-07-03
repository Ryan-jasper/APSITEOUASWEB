<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi Akun</title>
    @include('layouts.partials.head-assets')
</head>
<body>
    <div class="container-fluid auth-wrapper">
        <div class="row min-vh-100">
            <div class="col-lg-5 d-flex align-items-center justify-content-center auth-panel py-5 order-2 order-lg-1">
                <div class="deco-circle" style="width:220px;height:220px;top:-60px;left:-60px;"></div>
                <div class="deco-circle" style="width:160px;height:160px;bottom:-40px;right:-40px;"></div>
                <div class="text-center px-4" data-aos="fade-right" style="position:relative;">
                    <i class="bi bi-person-plus-fill" style="font-size:5rem; color: var(--yellow);"></i>
                    <h3 class="fw-bold mt-3">Gabung Jadi Anggota</h3>
                    <p style="opacity:.9;">Daftar sekarang, dan akunmu akan diverifikasi oleh Admin sebelum bisa mulai meminjam buku.</p>
                    <div class="auth-illustration justify-content-center">
                        <div class="spine"></div>
                        <div class="spine"></div>
                        <div class="spine"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-flex align-items-center justify-content-center py-5 order-1 order-lg-2">
                <div class="w-100 px-4" style="max-width: 460px;" data-aos="fade-left">
                    <h4 class="fw-bold mb-1"><i class="bi bi-person-plus text-primary"></i> Registrasi Akun</h4>
                    <p class="text-muted-soft mb-4">Lengkapi data berikut untuk mendaftar</p>

                    @include('layouts.partials.flash')

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Nama" value="{{ old('nama_lengkap') }}" required>
                            <label for="nama_lengkap">Nama Lengkap</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required>
                            <label for="username">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                            <label for="email">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="no_telp" id="no_telp" class="form-control" placeholder="No. Telp" value="{{ old('no_telp') }}">
                            <label for="no_telp">No. Telepon (opsional)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat" style="height:90px">{{ old('alamat') }}</textarea>
                            <label for="alamat">Alamat (opsional)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Konfirmasi" required>
                            <label for="password_confirmation">Konfirmasi Password</label>
                        </div>
                        <button class="btn btn-primary w-100 py-2"><i class="bi bi-check2-circle"></i>Daftar Sekarang</button>
                    </form>

                    <p class="text-center mt-4 mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="fw-semibold">Login di sini</a></p>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.partials.foot-assets')
</body>
</html>
