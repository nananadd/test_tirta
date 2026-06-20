<?php

namespace App\Exports;

use App\Models\TableB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TableBExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TableB::select('kode_toko', 'nominal_transaksi')->get();
    }

    public function headings(): array
    {
        return [
            'Kode Toko',
            'Nominal Transaksi',
        ];
    }
}