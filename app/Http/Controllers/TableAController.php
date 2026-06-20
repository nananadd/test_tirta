<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TableAService;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TableAImport;
use App\Exports\TableAExport;
use Barryvdh\DomPDF\Facade\Pdf;

class TableAController extends Controller
{
    protected $tableAService;

    public function __construct(TableAService $tableAService)
    {
        $this->tableAService = $tableAService;
    }

    public function index()
    {
        $table_a_data = $this->tableAService->getAll();
        return view('table_a.index', compact('table_a_data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_toko_baru' => 'required|integer|unique:table_a,kode_toko_baru',
            'kode_toko_lama' => 'nullable|integer',
        ]);

        $this->tableAService->create($validated);
        return redirect()->back()->with('success', 'Data Tabel A berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kode_toko_lama' => 'nullable|integer',
        ]);

        $this->tableAService->update($id, $validated);
        return redirect()->back()->with('success', 'Data Tabel A berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $this->tableAService->delete($id);
        return redirect()->back()->with('success', 'Data Tabel A berhasil dihapus!');
    }

    public function importExcel(Request $request)
    {
        $request->validate(['file_excel' => 'required|mimes:xlsx,xls']);
        Excel::import(new TableAImport, $request->file('file_excel'));
        return redirect()->back()->with('success', 'Data Tabel A berhasil di-import!');
    }

    public function exportExcel()
    {
        return Excel::download(new TableAExport, 'Data_Tabel_A.xlsx');
    }

    public function exportPdf()
    {
        $table_a_data = $this->tableAService->getAll();
        $pdf = Pdf::loadView('table_a.pdf', compact('table_a_data'));
        return $pdf->stream('Data_Tabel_A.pdf');
    }
}