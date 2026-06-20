<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SalesService;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SalesImport;
use App\Exports\SalesExport;
use Barryvdh\DomPDF\Facade\Pdf;

class SalesController extends Controller
{
    protected $salesService;

    public function __construct(SalesService $salesService)
    {
        $this->salesService = $salesService;
    }

    public function index()
    {
        $sales = $this->salesService->getAll();
        return view('sales.index', compact('sales'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_sales' => 'required|string|max:10|unique:table_d,kode_sales',
            'nama_sales' => 'required|string|max:50',
        ]);

        $this->salesService->create($validated);
        return redirect()->back()->with('success', 'Data Sales berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_sales' => 'required|string|max:50',
        ]);

        $this->salesService->update($id, $validated);
        return redirect()->back()->with('success', 'Data Sales berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $this->salesService->delete($id);
        return redirect()->back()->with('success', 'Data Sales berhasil dihapus!');
    }

    public function importExcel(Request $request)
    {
        $request->validate(['file_excel' => 'required|mimes:xlsx,xls']);
        Excel::import(new SalesImport, $request->file('file_excel'));
        return redirect()->back()->with('success', 'Data Sales berhasil di-import dari Excel!');
    }

    public function exportExcel()
    {
        return Excel::download(new SalesExport, 'Data_Sales.xlsx');
    }

    public function exportPdf()
    {
        $sales = $this->salesService->getAll();
        $pdf = Pdf::loadView('sales.pdf', compact('sales'));
        return $pdf->stream('Data_Sales.pdf');
    }
}