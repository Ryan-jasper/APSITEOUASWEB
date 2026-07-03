<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin</title>
    @include('layouts.partials.head-assets')
</head>
<body style="background: radial-gradient(circle at top right, rgba(255,201,40,.12), transparent 30rem), radial-gradient(circle at bottom left, rgba(54,191,208,.16), transparent 26rem), var(--navy);">
    <div class="container d-flex align-items-center justify-content-center" style="min-height:100vh;">
        <div class="w-100" style="max-width: 420px;" data-aos="zoom-in">
            <div class="card auth-card p-4">
                <div class="text-center mb-3">
                    <div class="mx-auto mb-2 d-flex align-items-center justify-content-center" style="width:64px;height:64px;border-radius:16px;background:linear-gradient(145deg, var(--navy), var(--tosca-dark));color:#fff;font-size:1.6rem;box-shadow:0 12px 24px rgba(21,155,173,.3);">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <h4 class="fw-bold mb-0">Login Admin</h4>
                    <p class="text-muted-soft small">Khusus pengelola perpustakaan</p>
                </div>

                @include('layouts.partials.flash')

                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="login" id="login" class="form-control" placeholder="Username/Email" value="{{ old('login') }}" required autofocus>
                        <label for="login">Username atau Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>
                    <button class="btn btn-dark w-100 py-2"><i class="bi bi-box-arrow-in-right"></i>Masuk sebagai Admin</button>
                </form>

                <p class="text-center mt-4 mb-0"><a href="{{ route('login') }}" class="text-muted-soft"><i class="bi bi-arrow-left"></i> Kembali ke login anggota</a></p>
            </div>
        </div>
    </div>
    @include('layouts.partials.foot-assets')
</body>
</html>
