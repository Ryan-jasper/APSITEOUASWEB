<div class="form-floating mb-3">
    <select name="kategori_id" id="kategori_id" class="form-select" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach ($kategoris as $k)
            <option value="{{ $k->kategori_id }}" @selected(old('kategori_id', $buku->kategori_id ?? '') == $k->kategori_id)>{{ $k->nama_kategori }}</option>
        @endforeach
    </select>
    <label for="kategori_id">Kategori</label>
</div>
<div class="form-floating mb-3">
    <input type="text" name="kode_buku" id="kode_buku" class="form-control" placeholder="Kode" value="{{ old('kode_buku', $buku->kode_buku ?? '') }}" required>
    <label for="kode_buku">Kode Buku</label>
</div>
<div class="form-floating mb-3">
    <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul" value="{{ old('judul', $buku->judul ?? '') }}" required>
    <label for="judul">Judul</label>
</div>
<div class="form-floating mb-3">
    <input type="text" name="penulis" id="penulis" class="form-control" placeholder="Penulis" value="{{ old('penulis', $buku->penulis ?? '') }}" required>
    <label for="penulis">Penulis</label>
</div>
<div class="form-floating mb-3">
    <input type="text" name="penerbit" id="penerbit" class="form-control" placeholder="Penerbit" value="{{ old('penerbit', $buku->penerbit ?? '') }}" required>
    <label for="penerbit">Penerbit</label>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-floating mb-3">
            <input type="number" name="tahun_terbit" id="tahun_terbit" class="form-control" placeholder="Tahun" value="{{ old('tahun_terbit', $buku->tahun_terbit ?? '') }}">
            <label for="tahun_terbit">Tahun Terbit</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating mb-3">
            <input type="number" name="stok" id="stok" class="form-control" placeholder="Stok" value="{{ old('stok', $buku->stok ?? 0) }}" required>
            <label for="stok">Stok</label>
        </div>
    </div>
</div>
<div class="form-floating mb-3">
    <input type="text" name="lokasi_rak" id="lokasi_rak" class="form-control" placeholder="Lokasi" value="{{ old('lokasi_rak', $buku->lokasi_rak ?? '') }}">
    <label for="lokasi_rak">Lokasi Rak</label>
</div>
