<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Exports\ApplicationsExport;
use Maatwebsite\Excel\Facades\Excel;

class ApplicationController extends Controller
{
    /**
     * USER melamar pekerjaan (upload CV).
     * POST /jobs/{job}/apply
     * route name: applications.store
     */
    public function store(Request $request, Job $job)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf|max:2048', // max 2MB
        ]);

        // Simpan file CV di storage/app/public/cvs
        $cvPath = $request->file('cv')->store('cvs', 'public');

        Application::create([
            'user_id' => Auth::id(),
            'job_id'  => $job->id,
            'cv'      => $cvPath,
            'status'  => 'Pending',
        ]);

        return back()->with('success', 'Lamaran berhasil dikirim!');
    }

    /**
     * ADMIN melihat daftar pelamar untuk 1 lowongan.
     * GET /jobs/{job}/applicants
     * route name: applications.index
     */
    public function index(Job $job)
    {
        $applications = Application::with('user', 'job')
            ->where('job_id', $job->id)
            ->get();

        return view('applications.index', [
            'job'          => $job,
            'applications' => $applications,
        ]);
    }

    /**
     * ADMIN mengubah status lamaran (Accepted / Rejected).
     * PUT /applications/{application}
     * route name: applications.update
     */
    public function update(Request $request, Application $application)
    {
        $request->validate([
            'status' => 'required|in:Pending,Accepted,Rejected',
        ]);

        $application->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status lamaran berhasil diperbarui.');
    }

    /**
     * ADMIN export semua pelamar ke Excel.
     * GET /applications/export
     * route name: applications.export
     */
    public function export()
    {
        return Excel::download(new ApplicationsExport, 'applications.xlsx');
    }

    /**
     * (Opsional) Download CV pelamar tertentu.
     * Bisa dipakai di tombol "Download CV".
     * GET /applications/{application}/download-cv
     */
    public function downloadCv(Application $application)
    {
        // Pastikan file ada dan pakai storage:link
        if (! Storage::disk('public')->exists($application->cv)) {
            return back()->with('error', 'File CV tidak ditemukan.');
        }

        return Storage::disk('public')->download($application->cv);
    }
}
