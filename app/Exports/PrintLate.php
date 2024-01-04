<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\late;


class PrintLate implements FromCollection, withHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return late::with('students')
            ->get()
            ->groupBy('student_id')
            ->map(function ($group) {
                $lates = $group->first();

                return [
                    $lates->students->nis,
                    $lates->students->name,
                    $lates->students->rombel->rombles,
                    $lates->students->rayon->rayon,
                    $group->count()
                ];
            });
        
    }

    public function headings(): array {
        return [
            'NIS', 'Nama', 'Rombel', 'Rayon', 'Jumlah Keterlambatan'
        ];
    }
}
