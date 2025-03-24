<?php

namespace App\Exports;

use App\Models\Pangkat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PangkatExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pangkat::all()->map(function ($data) {
            return [
                "nama" => $data->user->name,
                "tmt" => $data->tmt,
                "updated_at" => $data->updated_at
            ];
        });
    }

    public function headings(): array
    {
        return ["Nama", "TMT", "Tanggal Verifikasi"];
    }
}
