<?php

namespace App\Exports;

use App\Models\Kompetensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KompetensiExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Kompetensi::all()->map(function ($data) {
            return [
                "tanggal" => $data->tanggal,
                "nama" => $data->user->name,
                'judul' => $data->judul,
                'penyelenggara' => $data->penyelenggara,
                'tingkat' => $data->tingkat,
                'url' => url('storage/' . $data->sertifikat)
            ];
        });
    }

    public function headings(): array
    {
        return ["TANGGAL", "NAMA", "JUDUL", "PENYELENGGARA", "TINGKAT", "URL"];
    }
}
