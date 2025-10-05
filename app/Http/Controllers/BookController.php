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
        return view('buku.index', compact('data_buku', 'data_top', 'jumlah_buku', 'total_harga', 'max_harga', 'min_harga', 'pengarang', 'nama_pengarang', 'cari'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $buku = new Buku();
        $buku->judul = $request->input('judul');
        $buku->pengarang = $request->input('pengarang');
        $buku->harga = $request->input('harga');
        $buku->tgl_terbit = $request->input('tgl_terbit');
        $buku->save();

        return redirect()->route('buku.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.    
     */
    public function edit(string $id)
    {   
        $buku = Book::find($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, string $id)
    {
        $buku = Book::find($id);
        $buku->update($request->all());

        return redirect()->route('buku.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Book::find($id);
        if ($buku) {
            $buku->delete();
        }
        return redirect()->route('buku.index');
    }
}
