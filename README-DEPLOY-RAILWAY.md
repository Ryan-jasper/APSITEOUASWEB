# Panduan Deploy ke Railway

Zip ini sudah berisi project Laravel LENGKAP (skeleton Laravel 11 asli + semua
kode kamu: Model, Controller, View, Migration, Route sudah digabung jadi satu).
Kamu TIDAK perlu lagi menjalankan `composer create-project` atau copy-paste manual.

Yang BELUM ada di zip ini (memang sengaja, harus di-generate saat deploy):
- folder `vendor/` (dependency Laravel) — akan otomatis di-install oleh Railway
  lewat Composer saat proses build.
- file `.env` — akan diisi lewat Environment Variables di dashboard Railway.

## Langkah 1 — Upload ke GitHub

1. Extract zip ini ke sebuah folder di komputer kamu.
2. Buka folder itu di terminal/CMD, lalu jalankan:
   ```
   git init
   git add .
   git commit -m "initial commit"
   ```
3. Buat repo baru (kosong) di https://github.com/new, misal nama `perpustakaan-app`.
4. Hubungkan dan push:
   ```
   git remote add origin https://github.com/USERNAME_KAMU/perpustakaan-app.git
   git branch -M main
   git push -u origin main
   ```

## Langkah 2 — Bikin project di Railway

1. Buka https://railway.app, login pakai akun GitHub.
2. Klik **New Project** → **Deploy from GitHub repo** → pilih repo `perpustakaan-app` tadi.
3. Railway akan otomatis mendeteksi `nixpacks.toml` yang sudah disiapkan di zip ini,
   jadi build (composer install) dan start command sudah otomatis diatur. Tidak perlu
   diutak-atik lagi.

## Langkah 3 — Tambah database MySQL

1. Di dashboard project yang sama, klik **+ New** → **Database** → **Add MySQL**.
2. Railway akan bikin service MySQL baru otomatis (ini yang jadi database online kamu,
   menggantikan file `perpustakaan_db.sql` yang tadinya cuma di laptop).
3. Klik service MySQL itu → tab **Variables** → catat nilai:
   `MYSQLHOST`, `MYSQLPORT`, `MYSQLDATABASE`, `MYSQLUSER`, `MYSQLPASSWORD`.

## Langkah 4 — Set Environment Variables di service web (Laravel)

Klik service **web** (bukan yang MySQL) → tab **Variables** → **Raw Editor** → paste:

```
APP_NAME=Perpustakaan
APP_ENV=production
APP_DEBUG=false
APP_KEY=
APP_URL=https://NAMA-DOMAIN-KAMU.up.railway.app

DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

Catatan:
- Kalau nama service MySQL kamu bukan persis "MySQL", sesuaikan bagian `${{MySQL....}}`
  dengan nama service-nya (Railway punya fitur variable reference antar-service ini,
  bisa juga klik ikon "Add Variable Reference" di UI daripada ketik manual).
- `APP_URL` isi setelah kamu tahu domainnya (lihat Langkah 5), boleh diisi belakangan.

## Langkah 5 — Generate APP_KEY

Karena belum ada `.env` lokal, generate `APP_KEY` dengan salah satu cara:
- **Cara termudah:** di Railway, buka tab **Deployments** service web → klik deployment
  yang jalan → buka **Shell** (kalau tersedia di plan kamu) → jalankan:
  ```
  php artisan key:generate --show
  ```
  Copy hasilnya (`base64:xxxxx...`), paste ke variable `APP_KEY` di Langkah 4.
- **Alternatif:** generate manual di komputer sendiri kalau ada PHP terinstal:
  ```
  php artisan key:generate --show
  ```

Setelah `APP_KEY` diisi, Railway akan redeploy otomatis.

## Langkah 6 — Generate Domain

1. Di service web, buka tab **Settings** → **Networking** → klik **Generate Domain**.
2. Railway kasih URL publik, contoh: `perpustakaan-app-production.up.railway.app`.
3. Buka URL itu di browser.

## Langkah 7 — Cek migration & seeder sudah jalan

Start command di `nixpacks.toml` sudah otomatis menjalankan:
```
php artisan migrate --seed --force
```
setiap kali service start, jadi 10 tabel + akun default otomatis dibuat. Cek di
tab **Deploy Logs** kalau mau pastikan tidak ada error migration.

Login untuk testing:
- Admin: `admin` / `admin123` (lewat `/admin/login`)
- Anggota: `anggota` / `anggota123` (lewat `/login`)

## Troubleshooting umum

- **Error 500 / "Server Error"**: set `APP_DEBUG=true` sementara di Variables, buka
  lagi halamannya, baca pesan errornya, lalu kembalikan ke `false`.
- **"could not find driver"**: pastikan Railway pakai image PHP yang sudah ada
  ekstensi `pdo_mysql` — nixpacks bawaan PHP biasanya sudah include ini secara default.
- **Migration gagal / tabel tidak lengkap**: cek Deploy Logs, biasanya karena env DB_*
  belum benar ke-link ke service MySQL.
- **Asset css/js tidak muncul**: pastikan path di Blade view memanggil
  `/css/custom.css` dan `/js/custom.js` (bukan lewat Vite), karena project ini
  memakai file custom manual, bukan build Vite.
