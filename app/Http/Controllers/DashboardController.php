<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data dari API
        $response = Http::get(url('/api/books'));
        $data = $response->json();

        return view('dashboard', compact('data'));
    }
}
