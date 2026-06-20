<?php

namespace App\Imports;

use App\Models\TableC;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TableCImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new TableC([
            'kode_toko' => $row['kode_toko'],
            'area_sales' => $row['area_sales'],
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
            'area_sales' => 'required|string',
        ];
    }
}