<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Imports\JobsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JobController extends Controller
{
    /**
     * Daftar lowongan untuk USER (route: jobs.index).
     * Dipanggil dari route:
     * GET /jobs (auth, tanpa isAdmin)
     */
    public function index()
    {
        // Bisa kamu ganti dengan pagination kalau mau
        $jobs = Job::latest()->get();

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Detail 1 lowongan untuk USER (route: jobs.show).
     * GET /jobs/{job}
     */
    public function show(Job $job)
    {
        // Bisa juga ambil relasi applications kalau perlu
        return view('jobs.show', compact('job'));
    }

    /**
     * Form tambah lowongan (ADMIN).
     * GET /jobs/create
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Simpan lowongan baru (ADMIN).
     * POST /jobs
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string|max:255',
            'company'     => 'required|string|max:255',
            'salary'      => 'required|numeric',
        ]);

        Job::create($validated);

        return redirect()->route('jobs.index')
            ->with('success', 'Lowongan berhasil ditambahkan.');
    }

    /**
     * Form edit lowongan (ADMIN).
     * GET /jobs/{job}/edit
     */
    public function edit(Job $job)
    {
        return view('jobs.edit', compact('job'));
    }

    /**
     * Update lowongan (ADMIN).
     * PUT /jobs/{job}
     */
    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string|max:255',
            'company'     => 'required|string|max:255',
            'salary'      => 'required|numeric',
        ]);

        $job->update($validated);

        return redirect()->route('jobs.index')
            ->with('success', 'Lowongan berhasil diperbarui.');
    }

    /**
     * Hapus lowongan (ADMIN).
     * DELETE /jobs/{job}
     */
    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('jobs.index')
            ->with('success', 'Lowongan berhasil dihapus.');
    }

    /**
     * Import lowongan dari file Excel (ADMIN).
     * POST /jobs/import
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new JobsImport, $request->file('file'));

        return back()->with('success', 'Data lowongan berhasil diimport.');
    }
}
