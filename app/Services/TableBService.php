<?php

namespace App\Services;

use App\Models\TableB;

class TableBService
{
    public function getAllTransactions()
    {
        return TableB::all();
    }

    public function createTransaction(array $data)
    {
        return TableB::create([
            'kode_toko' => $data['kode_toko'],
            'nominal_transaksi' => $data['nominal_transaksi'],
        ]);
    }

    public function updateTransaction($id, array $data)
    {
        $item = TableB::findOrFail($id);
        
        $item->update([
            'nominal_transaksi' => $data['nominal_transaksi'],
        ]);

        return $item;
    }

    public function deleteTransaction($id)
    {
        $item = TableB::findOrFail($id);
        return $item->delete();
    }

    public function getPaginated($perPage = 10, $search = null)
    {
        return TableB::when($search, function ($query) use ($search) {
        $query->where('kode_toko', 'like', "%{$search}%")
            ->orWhere('nominal_transaksi', 'like', "%{$search}%");
    })
    ->paginate($perPage)
    ->withQueryString();
    }
}