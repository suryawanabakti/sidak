<?php

namespace App\Exports;

use App\Models\Organisasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrganisasiExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Organisasi::all()->map(function ($data) {
            return [
                "Nama" => $data->user->name,
                "nama_organisasi" => $data->nama_organisasi,
                "tanggal_aktif" => $data->tanggal_aktif,
                "tanggal_berakhir" => $data->tanggal_berakhir,
                "updated_at" => $data->updated_at,
            ];
        });
    }

    public function headings(): array
    {
        return ["Nama", "Nama Organisasi", "Tanggal Aktif", "Tanggal Berakhir", "Tanggal Diverifikasi"];
    }
}
