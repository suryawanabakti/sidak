<?php

namespace App\Exports;

use App\Models\Bkd;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BkdExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Bkd::where('status', 'diterima')->get()->map(function ($data) {
            return [
                "tanggal" => $data->created_at->format('Y-m-d'),
                "nama" => $data->user->name,
                "semester" => $data->semester,
                "file" => url('storage/' . $data->file)
            ];
        });
    }



    public function headings(): array
    {
        return ["TANGGAL", "Nama", "Semester", "file"];
    }
}
