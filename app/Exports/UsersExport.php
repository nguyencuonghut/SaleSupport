<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class UsersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    public function headings(): array
    {
        return [
            'ID',
            'Tên',
            'Email',
            'Quyền',
            'Phòng ban',
        ];
    }
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->type,
            $user->department->name,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
            'A'  => ['alignment' => ['horizontal' => 'left']],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 30,
            'C' => 35,
            'D' => 10,
            'E' => 25,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('id', 'name', 'email', 'type', 'department_id')->get();
    }
}
