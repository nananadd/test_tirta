<?php

namespace App\Exports;

use App\Models\TableB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class TableBExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    public function collection()
    {
        return TableB::select('kode_toko', 'nominal_transaksi')->get();
    }

    public function headings(): array
    {
        return [
            'Kode Toko',
            'Nominal Transaksi',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => '"Rp "#,##0', 
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $fullRange = 'A1:' . $highestColumn . $highestRow;
        $dataRange = 'A2:' . $highestColumn . $highestRow;

        $sheet->getStyle('A1:' . $highestColumn . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => '11794A'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle($dataRange)->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle($fullRange)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'D1EADD'],
                ],
            ],
        ]);

        $sheet->getRowDimension(1)->setRowHeight(30);
        for ($row = 2; $row <= $highestRow; $row++) {
            $sheet->getRowDimension($row)->setRowHeight(22);
        }
        
        $sheet->getStyle('B2:B'.$highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        return [];
    }
}