<?php

namespace App\Exports;

use App\Models\Paten;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PatenExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return ["Tanggal", "Nama", "Judul", "Anggota", "Tanggal Verifikasi"];
    }
    public function collection()
    {
        return Paten::all()->map(function ($data) {
            return [
                "tanggal" => $data->tanggal,
                "user->name" => $data->user->name,
                "judul" => $data->judul,
                "anggota" => $data->anggota,
                "updated_at" => $data->updated_at,
            ];
        });
    }
}
