<?php

namespace App\Exports;

use App\Models\Sales;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Sales::select('kode_sales', 'nama_sales')->get();
    }

    public function headings(): array
    {
        return [
            'Kode Sales',
            'Nama Sales',
        ];
    }
}