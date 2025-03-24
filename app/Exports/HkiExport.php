<?php

namespace App\Exports;

use App\Models\Hki;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HkiExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Hki::all()->map(function ($data) {
            return [
                "tanggal_verifikasi" => $data->updated_at,
                "nama" => $data->user->name,
                "judul" => $data->judul,
                "anggota" => $data->anggota,
            ];
        });
    }

    public function headings(): array
    {
        return ["Tanggal Verifikasi", "Nama", "Judul", "Penerbit", "Anggota"];
    }
}
