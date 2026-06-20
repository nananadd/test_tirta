<?php

namespace App\Exports;

use App\Models\TableA;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TableAExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TableA::select('kode_toko_baru', 'kode_toko_lama')->get();
    }

    public function headings(): array
    {
        return [
            'Kode Toko Baru',
            'Kode Toko Lama',
        ];
    }
}