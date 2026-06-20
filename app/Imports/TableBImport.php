<?php

namespace App\Imports;

use App\Models\TableB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TableBImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new TableB([
            'kode_toko' => $row['kode_toko'],
            'nominal_transaksi' => $row['nominal_transaksi'],
        ]);
    }

    public function headingRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            'kode_toko' => 'required|integer',
            'nominal_transaksi' => 'required|numeric',
        ];
    }
}