<?php

namespace App\Services;

use App\Models\TableA;

class TableAService
{
    public function getAll()
    {
        return TableA::all();
    }

    public function create(array $data)
    {
        return TableA::create([
            'kode_toko_baru' => $data['kode_toko_baru'],
            'kode_toko_lama' => $data['kode_toko_lama'] ?? null,
        ]);
    }

    public function update($id, array $data)
    {
        $item = TableA::findOrFail($id);
        $item->update([
            'kode_toko_lama' => $data['kode_toko_lama'] ?? null,
        ]);
        return $item;
    }

    public function delete($id)
    {
        $item = TableA::findOrFail($id);
        return $item->delete();
    }
}