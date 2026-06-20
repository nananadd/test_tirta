<?php

namespace App\Imports;

use App\Models\Sales;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SalesImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Sales([
            'kode_sales' => $row['kode_sales'],
            'nama_sales' => $row['nama_sales'],
        ]);
    }

    public function headingRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            'kode_sales' => 'required|string',
            'nama_sales' => 'required|string',
        ];
    }
}