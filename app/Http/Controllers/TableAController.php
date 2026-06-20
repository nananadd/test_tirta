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

    public function index(Request $request)
    {
        $search = $request->search;
        $table_a_data = $this->tableAService->getPaginated(10, $search);

        return view('table_a.index', compact('table_a_data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_toko_baru' => 'required|integer|unique:table_a,kode_toko_baru',
            'kode_toko_lama' => 'nullable|integer|different:kode_toko_baru|unique:table_a,kode_toko_lama',
        ], [
            'kode_toko_baru.unique' => 'Gagal! Kode Toko Baru tersebut sudah terdaftar di sistem.',
            'kode_toko_lama.different' => 'Gagal! Kode Toko Lama TIDAK BOLEH SAMA dengan Kode Toko Baru.',
            'kode_toko_lama.unique' => 'Gagal! Kode Toko Lama tersebut sudah dipakai oleh toko lain.'
        ]);

        $this->tableAService->create($validated);
        return redirect()->back()->with('success', 'Data Toko berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kode_toko_lama' => [
                'nullable',
                'integer',
                function ($attribute, $value, $fail) use ($id) {
                    if ($value == $id) {
                        $fail('Gagal! Kode Toko Lama TIDAK BOLEH SAMA dengan Kode Toko Baru.');
                    }
                },
                'unique:table_a,kode_toko_lama,' . $id . ',kode_toko_baru'
            ],
        ], [
            'kode_toko_lama.unique' => 'Gagal! Kode Toko Lama tersebut sudah dipakai oleh toko lain.'
        ]);

        $this->tableAService->update($id, $validated);
        return redirect()->back()->with('success', 'Data Toko berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $this->tableAService->delete($id);
        return redirect()->back()->with('success', 'Data Toko berhasil dihapus!');
    }

    public function importExcel(Request $request)
    {
        $request->validate(['file_excel' => 'required|mimes:xlsx,xls']);
        Excel::import(new TableAImport, $request->file('file_excel'));
        return redirect()->back()->with('success', 'Data Toko berhasil di-import!');
    }

    public function exportExcel()
    {
        return Excel::download(new TableAExport, 'Data_Toko.xlsx');
    }

    public function exportPdf()
    {
        $table_a_data = $this->tableAService->getAll();
        $pdf = Pdf::loadView('table_a.pdf', compact('table_a_data'));
        return $pdf->stream('Data_Toko.pdf');
    }
}