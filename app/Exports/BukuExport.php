<?php

namespace App\Exports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BukuExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Buku::all()->map(function ($data) {
            return [
                "tanggal_verifikasi" => $data->updated_at,
                "nama" => $data->user->name,
                "judul" => $data->judul,
                "penerbit" => $data->penerbit,
                "tahun" => $data->tahun,
                "anggota" => $data->anggota,
            ];
        });
    }

    public function headings(): array
    {
        return ["Tanggal Verifikasi", "Nama", "Judul", "Penerbit", "Tahun", "Anggota"];
    }
}
