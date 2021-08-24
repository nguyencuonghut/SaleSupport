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
            'Tiêu đề',
            'Nội dung',
            'Bắt đầu',
            'Kết thúc',
        ];
    }
    public function map($policy): array
    {
        return [
            $policy->id,
            $policy->title,
            strip_tags($policy->content),
            $policy->start,
            $policy->end,
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
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 35,
            'C' => 35,
            'D' => 20,
            'E' => 20,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Policy::select('id', 'title', 'content', 'start', 'end')->get();
    }
}
