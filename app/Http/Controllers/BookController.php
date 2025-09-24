<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $pengarang = Book::select('pengarang')->distinct()->get();
        $nama_pengarang = $request->input('pengarang', 'all');
        $cari = $request->input('cari', '');

        $query = Book::query();

        if ($nama_pengarang !== 'all') {
            $query->where('pengarang', $nama_pengarang);
        }

        if ($cari) {
            $query->where('judul', 'like', '%' . $cari . '%');
        }

        $data_top = Book::orderBy('id', 'desc')->take(5)->get();
        $data_buku = $query->get();
        $jumlah_buku = Book::count();
        $total_harga = Book::sum('harga');
        $max_harga = Book::max('harga');
        $min_harga = Book::min('harga');
        return view('index', compact('data_buku', 'data_top', 'jumlah_buku', 'total_harga', 'max_harga', 'min_harga', 'pengarang', 'nama_pengarang', 'cari'));
    }
}
