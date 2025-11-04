<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Data Buku</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>{{-- resources/views/buku/layout.blade.php --}}

<x-app-layout>
    {{-- Header di bagian atas (judul halaman) --}}
    <x-slot name="header">
        <div class="hero text-center" style="padding: 20px;">
            <h2>Perpustakaan Kandang Buaya</h2>
            <p>Selamat datang di perpustakaan kami! Temukan berbagai buku menarik di sini.</p>
        </div>
    </x-slot>

    {{-- Konten utama halaman --}}
    <div class="py-8">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            {{-- Kalau kamu mau tetap pakai Bootstrap container, bisa tambah div lagi di sini --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @yield('content')
            </div>
        </div>
    </div>
</x-app-layout>
