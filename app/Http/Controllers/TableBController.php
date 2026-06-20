<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TableBService;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TableBImport;
use App\Exports\TableBExport;
use Barryvdh\DomPDF\Facade\Pdf;

class TableBController extends Controller
{
    protected $tableBService;

    public function __construct(TableBService $tableBService)
    {
        $this->tableBService = $tableBService;
    }

    public function index()
    {
        $table_b_data = $this->tableBService->getAllTransactions();
        return view('table_b.index', compact('table_b_data'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_toko' => 'required|integer|unique:table_b,kode_toko',
            'nominal_transaksi' => 'required|numeric',
        ]);

        $this->tableBService->createTransaction($validatedData);

        return redirect()->back()->with('success', 'Data Transaksi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nominal_transaksi' => 'required|numeric',
        ]);

        $this->tableBService->updateTransaction($id, $validatedData);

        return redirect()->route('table_b.index')->with('success', 'Data Tabel B berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $this->tableBService->deleteTransaction($id);
        return redirect()->back()->with('success', 'Data Tabel B berhasil dihapus!');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new TableBImport, $request->file('file_excel'));

        return redirect()->back()->with('success', 'Data Tabel B berhasil di-import dari Excel!');
    }

    public function exportExcel()
    {
        return Excel::download(new TableBExport, 'Data_Tabel_B.xlsx');
    }

    public function exportPdf()
    {
        $table_b_data = $this->tableBService->getAllTransactions();
        $pdf = Pdf::loadView('table_b.pdf', compact('table_b_data'));
        return $pdf->stream('Data_Tabel_B.pdf');
    }
}