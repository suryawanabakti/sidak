<?php

namespace App\Exports;

use App\Models\Ijazah;
use Maatwebsite\Excel\Concerns\FromCollection;

class IjazahExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Ijazah::all();
    }
}
