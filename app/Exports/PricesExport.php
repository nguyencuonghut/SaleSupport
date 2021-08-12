<?php

namespace App\Exports;

use App\Models\Price;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class PricesExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithColumnFormatting
{

    public function headings(): array
    {
        return [
            'ID',
            'Mã sản phẩm',
            'Trừ trực tiếp',
            'Giá nhà máy',
            'Giá kho',
            'Giá kho Hà Tĩnh',
            'Thời gian tạo'
        ];
    }
    public function map($price): array
    {
        return [
            $price->id,
            $price->product->code,
            $price->discount,
            $price->company_price,
            $price->warehouse_price,
            $price->ht_warehouse_price,
            $price->created_at,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => '#,##0',
            'E' => '#,##0',
            'F' => '#,##0',
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
            'D'  => ['alignment' => ['horizontal' => 'left']],
            'E'  => ['alignment' => ['horizontal' => 'left']],
            'F'  => ['alignment' => ['horizontal' => 'left']],
            'G'  => ['alignment' => ['horizontal' => 'left']],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 15,
            'C' => 15,
            'D' => 15,
            'E' => 15,
            'F' => 15,
            'G' => 25,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Price::select('id', 'product_id', 'company_price', 'warehouse_price', 'ht_warehouse_price', 'discount', 'created_at')->get();
    }
}
