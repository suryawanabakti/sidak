<?php

namespace App\Exports;

use App\Models\JabatanFungsional;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JabatanFungsionalExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return JabatanFungsional::all()->map(function ($data) {
            return [
                "user" => $data->user->name,
                "tmt" => $data->tmt,
                "updated_at" => $data->updated_at,
            ];
        });
    }

    public function headings(): array
    {
        return ["Nama", "TMT", "Tanggal Verifikasi"];
    }
}
