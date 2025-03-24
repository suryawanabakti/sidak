<?php

namespace App\Exports;

use App\Models\Skp;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SkpExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return ["Nama", "Tahun", "Tanggal Diverifikasi"];
    }

    public function collection()
    {
        return Skp::all()->map(fn($data) => [
            "nama" => $data->user->name,
            "tahun" => $data->tahun,
            "tanggal_diverifikasi" => $data->updated_at
        ]);
    }
}
