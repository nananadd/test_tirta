<?php

namespace App\Services;

use App\Models\Sales;

class SalesService
{
    public function getAll()
    {
        return Sales::all();
    }

    public function create(array $data)
    {
        return Sales::create([
            'kode_sales' => $data['kode_sales'],
            'nama_sales' => $data['nama_sales'],
        ]);
    }

    public function update($id, array $data)
    {
        $item = Sales::findOrFail($id);
        $item->update([
            'nama_sales' => $data['nama_sales'],
        ]);
        return $item;
    }

    public function delete($id)
    {
        $item = Sales::findOrFail($id);
        return $item->delete();
    }
}