@extends('layouts.admin')
@section('title', 'Tambah Buku')
@section('content')
    <div class="card p-4" style="max-width:640px;" data-aos="fade-up">
        <form method="POST" action="{{ route('admin.buku.store') }}">
            @csrf
            @include('admin.buku._form')
            <button class="btn btn-primary"><i class="bi bi-check2-circle"></i>Simpan</button>
        </form>
    </div>
@endsection
