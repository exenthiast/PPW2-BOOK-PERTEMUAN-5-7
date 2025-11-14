<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Email</title>
    {{-- Tambahkan Bootstrap CDN agar tampilan rapi --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Kirim Email</h4>
                </div>
                <div class="card-body">
                    {{-- Pesan sukses --}}
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Form kirim email --}}
                    <form action="{{ route('post-email') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nama pengirim" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Tujuan</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Alamat email penerima" required>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subjek</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Judul atau subjek email" required>
                        </div>

                        <div class="mb-3">
                            <label for="body" class="form-label">Isi Pesan</label>
                            <textarea name="body" id="body" rows="5" class="form-control" placeholder="Tulis isi pesan di sini..." required></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-4">Kirim Email</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Bootstrap JS (opsional) --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
