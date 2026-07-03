@extends('layouts.admin')
@section('title', 'Ubah Kategori')
@section('content')    <div class="card p-4" style="max-width:520px;" data-aos="fade-up">
        <form method="POST" action="{{ route('admin.kategori.update', $kategori->kategori_id) }}">
            @csrf
            @method('PUT')
            <div class="form-floating mb-3">
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" placeholder="Nama" value="{{ $kategori->nama_kategori }}" required>
                <label for="nama_kategori">Nama Kategori</label>
            </div>
            <div class="form-floating mb-3">
                <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi" style="height:100px">{{ $kategori->deskripsi }}</textarea>
                <label for="deskripsi">Deskripsi</label>
            </div>
            <button class="btn btn-primary"><i class="bi bi-check2-circle"></i>Simpan Perubahan</button>
        </form>
    </div>
@endsection
