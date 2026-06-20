<?php

namespace App\Imports;

use App\Models\TableA;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TableAImport implements ToModel, WithHeadingRow, WithValidation 
{
    public function model(array $row)
    {
        return new TableA([
            'kode_toko_baru' => $row['kode_toko_baru'],
            'kode_toko_lama' => $row['kode_toko_lama'] ?? null,
        ]);
    }

    public function headingRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            'kode_toko_baru' => 'required|integer|unique:table_a,kode_toko_baru', 
            'kode_toko_lama' => 'nullable|integer|different:kode_toko_baru|unique:table_a,kode_toko_lama',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'kode_toko_baru.unique' => 'Gagal Import: Kode Toko Baru :input sudah terdaftar di database.',
            'kode_toko_lama.different' => 'Gagal Import: Kode Toko Lama tidak boleh sama dengan Kode Toko Baru.',
            'kode_toko_lama.unique' => 'Gagal Import: Kode Toko Lama :input sudah dipakai oleh toko lain.',
        ];
    }
}