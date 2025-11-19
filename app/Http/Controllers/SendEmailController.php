<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\SendEmail;
use App\Jobs\SendMailJob;
use App\Models\Application;

class SendEmailController extends Controller
{
    public function index(Request $request)
    {
        $application = null;
        
        // Jika ada parameter application_id, ambil data pelamar
        if ($request->has('application_id')) {
            $application = Application::with('user')->findOrFail($request->application_id);
        }
        
        return view('emails.kirim-email', compact('application'));
    }
    
    public function store(Request $request)
    {
        $data = $request->all();

        dispatch(new SendMailJob($data));
        return redirect()->route('kirim-email')
        ->with('success', 'Email telah dikirim dan diproses di latar belakang!');
    }
}
