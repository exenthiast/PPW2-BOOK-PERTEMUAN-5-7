<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function store(Request $request, $job_id)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $cvPath = $request->file('cv')->store('cvs', 'public');

        \App\Models\Application::create([
            'user_id' => auth()->id(),
            'job_id' => $job_id,
            'cv' => $cvPath,
        ]);

        return redirect()->back()->with('success', 'Application submitted successfully.');
    }
}
