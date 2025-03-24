<?php

namespace App\Exports;

use App\Models\Serdos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SerdosExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return ["TMT", "Nama", "Tanggal Verifikasi"];
    }
    public function collection()
    {
        return Serdos::all()->map(function ($data) {
            return [
                "tmt" => $data->tmt,
                "user->name" => $data->user->name,
                "updated_at" => $data->updated_at,
            ];
        });
    }
}
