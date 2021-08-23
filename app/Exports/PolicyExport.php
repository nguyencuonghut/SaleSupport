<?php

namespace App\Exports;

use App\Models\Policy;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class PolicyExport implements FromCollection,  WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    public function headings(): array
    {
        return [
            'ID',
            'Tên',
            'Nội dung',
            'Thời gian áp dụng',
        ];
    }
    public function map($policy): array
    {
        return [
            $policy->id,
            $policy->name,
            strip_tags($policy->content),
            $policy->date_range,
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
            'B' => 35,
            'C' => 35,
            'D' => 30,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Policy::select('id', 'name', 'content', 'date_range')->get();
    }
}
