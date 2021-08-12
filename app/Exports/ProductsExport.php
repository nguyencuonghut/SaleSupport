<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class ProductsExport implements FromCollection,  WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    public function headings(): array
    {
        return [
            'ID',
            'Mã',
            'Quy cách',
        ];
    }
    public function map($user): array
    {
        return [
            $user->id,
            $user->code,
            $user->weight,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
            'A'  => ['alignment' => ['horizontal' => 'left']],
            'B'  => ['alignment' => ['horizontal' => 'left']],
            'C'  => ['alignment' => ['horizontal' => 'left']],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 25,
            'C' => 10,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::select('id', 'code', 'weight')->get();
    }
}
