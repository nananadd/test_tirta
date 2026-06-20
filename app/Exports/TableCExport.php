<?php

namespace App\Exports;

use App\Models\TableC;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TableCExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TableC::select('kode_toko', 'area_sales')->get();
    }

    public function headings(): array
    {
        return [
            'Kode Toko',
            'Area Sales',
        ];
    }
}