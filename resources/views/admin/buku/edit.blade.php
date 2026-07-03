@extends('layouts.admin')
@section('title', 'Ubah Buku')
@section('content')
    <div class="card p-4" style="max-width:640px;" data-aos="fade-up">
        <form method="POST" action="{{ route('admin.buku.update', $buku->buku_id) }}">
            @csrf
            @method('PUT')
            @include('admin.buku._form')
            <button class="btn btn-primary"><i class="bi bi-check2-circle"></i>Simpan Perubahan</button>
        </form>
    </div>
@endsection
