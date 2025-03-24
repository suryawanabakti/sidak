<?php

namespace App\Exports;

use App\Models\Ijazah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IjazahExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Ijazah::all()->map(function ($data) {
            return [
                "tanggal" => $data->updated_at,
                "nama" => $data->user->name,
                "pendidikan" => $data->pendidikan,
                "tipe" => $data->tipe,
            ];
        });
    }

    public function headings(): array
    {
        return ["Tanggal Verifikasi", "Nama", "Pendidikan", "Tipe"];
    }
}
