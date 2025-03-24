<?php

namespace App\Exports;

use App\Models\Prestasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PrestasiExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return ["Tanggal", "Nama", "Judul", 'Tingkat', 'Tanggal Verifikasi'];
    }
    public function collection()
    {
        return Prestasi::all()->map(fn($data) => [
            "tanggal" => $data->tanggal,
            "user->name" => $data->user->name,
            "judul" => $data->judul,
            "tingkat" => $data->tingkat,
            "updated_at" => $data->updated_at,
        ]);
    }
}
