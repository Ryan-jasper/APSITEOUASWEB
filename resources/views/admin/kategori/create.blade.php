@extends('layouts.admin')
@section('title', 'Tambah Kategori')
@section('content')    <div class="card p-4" style="max-width:520px;" data-aos="fade-up">
        <form method="POST" action="{{ route('admin.kategori.store') }}">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" placeholder="Nama" required>
                <label for="nama_kategori">Nama Kategori</label>
            </div>
            <div class="form-floating mb-3">
                <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi" style="height:100px"></textarea>
                <label for="deskripsi">Deskripsi</label>
            </div>
            <button class="btn btn-primary"><i class="bi bi-check2-circle"></i>Simpan</button>
        </form>
    </div>
@endsection
