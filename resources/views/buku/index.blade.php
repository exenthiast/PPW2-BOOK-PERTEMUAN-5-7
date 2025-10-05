@extends('buku.layout')

@section('content')
        <div class="container d-flex justify-content-center mt-3" style="min-height: 100vh;">
            <div class="w-100">
                <h1 class="text-center mb-4">Top 5 Buku Terbaru</h1>
                <a href="{{ route('buku.create') }}" class="btn btn-primary float-end mb-3">Tambah Buku</a>
                <table class="table table-striped table-bordered mb-5 mx-auto">
                    <thead class="table-dark">
                        <tr>
                            <th>id</th>
                            <th>Judul Buku</th>
                            <th>Pengarang</th>
                            <th>Harga</th>
                            <th>Tanggal Terbit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_top as $buku)
                        <tr>
                            <td>{{ $buku->id }}</td>
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->pengarang }}</td>
                            <td>{{ "Rp. ".number_format($buku->harga, 2, ',', '.') }}</td>
                            <td>{{ $buku->tgl_terbit->format('d-m-Y') }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                <h1 class="text-center mb-4">Data Semua Buku</h1>
                <div class="row mb-4 align-items-center">
                    <div class="col-md-6">
                        <form method="GET" class="d-inline">
                            <select name="pengarang" onchange="this.form.submit()" class="form-select w-auto">
                                <option value="all">Semua Pengarang</option>
                                @foreach ($pengarang as $p)
                                    <option value="{{ $p->pengarang }}" {{ ($nama_pengarang == $p->pengarang) ? 'selected' : '' }}>
                                        {{ $p->pengarang }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="col-md-6 text-end">
                        <form method="GET" class="d-inline">
                            <div class="input-group w-75 float-end">
                                <input type="text" name="cari" class="form-control" placeholder="Cari judul buku..." value="{{ request('cari') }}">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-striped table-bordered mx-auto">
                    <thead class="table-dark">
                        <tr>
                            <th>id</th>
                            <th>Judul Buku</th>
                            <th>Pengarang</th>
                            <th>Harga</th>
                            <th>Tanggal Terbit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data_buku->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center text-danger">Tidak ada buku yang ditemukan.</td>
                            </tr>
                        @else
                            @foreach ($data_buku as $buku)
                            <tr>
                                <td>{{ $buku->id }}</td>
                                <td>{{ $buku->judul }}</td>
                                <td>{{ $buku->pengarang }}</td>
                                <td>{{ "Rp. ".number_format($buku->harga, 2, ',', '.') }}</td>
                                <td>{{ $buku->tgl_terbit->format('d-m-Y') }}</td>
                                <td><div class="d-flex gap-2">
                                    <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="row justify-content-center mb-4">
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-header bg-primary text-white text-center">
                                <strong>Statistik Buku</strong>
                            </div>
                            <div class="card-body">
                                <p class="mb-2"><strong>Total Buku:</strong> {{ $jumlah_buku }}</p>
                                <p class="mb-2"><strong>Total Harga Semua:</strong> Rp. {{ number_format($total_harga, 2, ',', '.') }}</p>
                                <p class="mb-2"><strong>Harga Tertinggi:</strong> Rp. {{ number_format($max_harga, 2, ',', '.') }}</p>
                                <p class="mb-0"><strong>Harga Terendah:</strong> Rp. {{ number_format($min_harga, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection