<?php

namespace App\Exports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromCollection;

class ApplicationsExport implements FromCollection
{
    /**
     * Mengembalikan data yang akan diexport ke Excel.
     */
    public function collection()
    {
        // Bisa kamu sesuaikan (filter by job_id, dsb)
        return Application::with('user', 'job')->get();
    }
}
