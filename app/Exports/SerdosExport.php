<?php

namespace App\Exports;

use App\Models\Serdos;
use Maatwebsite\Excel\Concerns\FromCollection;

class SerdosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Serdos::all();
    }
}
