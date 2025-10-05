@extends('buku.layout')

@section('content')
<div class="container">
    <h4>Tambah Buku</h4>
    <form method="POST" action="{{ route('buku.store') }}">
        @csrf
        <div>Judul Buku <input type="text" name="judul" class="form-control mb-3"></div>
        <div>Penulis <input type="text" name="penulis" class="form-control mb-3"></div>
        <div>Harga <input type="text" name="harga" class="form-control mb-3"></div>
        <div>Tanggal Terbit <input type="date" name="tgl_terbit" class="form-control mb-3"></div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('buku.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection