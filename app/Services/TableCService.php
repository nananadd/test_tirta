<?php

namespace App\Services;

use App\Models\TableC;

class TableCService
{
    public function getAll()
    {
        return TableC::all();
    }

    public function create(array $data)
    {
        return TableC::create([
            'kode_toko' => $data['kode_toko'],
            'area_sales' => $data['area_sales'],
        ]);
    }

    public function update($id, array $data)
    {
        $item = TableC::findOrFail($id);
        $item->update([
            'area_sales' => $data['area_sales'],
        ]);
        return $item;
    }

    public function delete($id)
    {
        $item = TableC::findOrFail($id);
        return $item->delete();
    }
}