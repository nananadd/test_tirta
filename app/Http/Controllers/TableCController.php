<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TableCService;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TableCImport;
use App\Exports\TableCExport;
use Barryvdh\DomPDF\Facade\Pdf;

class TableCController extends Controller
{
    protected $tableCService;

    public function __construct(TableCService $tableCService)
    {
        $this->tableCService = $tableCService;
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $table_c_data = $this->tableCService->getPaginated(10, $search);

        return view('table_c.index', compact('table_c_data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_toko' => 'required|integer|unique:table_c,kode_toko',
            'area_sales' => 'required|string|max:10',
        ]);

        $this->tableCService->create($validated);
        return redirect()->back()->with('success', 'Data Tabel C berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'area_sales' => 'required|string|max:10',
        ]);

        $this->tableCService->update($id, $validated);
        return redirect()->back()->with('success', 'Data Tabel C berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $this->tableCService->delete($id);
        return redirect()->back()->with('success', 'Data Tabel C berhasil dihapus!');
    }

    public function importExcel(Request $request)
    {
        $request->validate(['file_excel' => 'required|mimes:xlsx,xls']);
        Excel::import(new TableCImport, $request->file('file_excel'));
        return redirect()->back()->with('success', 'Data Tabel C berhasil di-import!');
    }

    public function exportExcel()
    {
        return Excel::download(new TableCExport, 'Data_Tabel_C.xlsx');
    }

    public function exportPdf()
    {
        $table_c_data = $this->tableCService->getAll();
        $pdf = Pdf::loadView('table_c.pdf', compact('table_c_data'));
        return $pdf->stream('Data_Tabel_C.pdf');
    }
}