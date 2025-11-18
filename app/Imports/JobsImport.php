<?php

namespace App\Imports;

use App\Models\Job;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JobsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Job([
            'title'       => $row['title'],       // pastikan sama dengan header Excel
            'description' => $row['description'],
            'location'    => $row['location'],
            'company'     => $row['company'],
            'salary'      => $row['salary'],
        ]);
    }
}
