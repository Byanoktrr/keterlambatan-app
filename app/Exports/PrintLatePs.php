<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\late;


class PrintLatePs implements FromCollection, withHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $ps;

    public function __construct($ps)
    {
        $this->ps = $ps;
    }

    public function collection()
    {
        return Late::with('students') ->whereHas('students.rayon', function ($query) {
            $query->where('rayon_id', $this->ps);
        })->get()->groupBy('student_id')->map(function ($group) {
            
            $lates = $group->first();

            return [
                $lates->students->nis,
                $lates->students->name,
                $lates->students->rayon->rayon,
                $lates->students->rombel->rombles,
                $group->count()
            ];
        });
    }

    public function headings(): array
    {
        return
        [
            "NIS", "Nama", "Rayon", "Rombel", "Jumlah Keterlambatan"
        ];
    }
}
