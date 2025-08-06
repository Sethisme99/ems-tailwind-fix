<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceSummaryAllExport implements FromArray, WithHeadings
{
    protected $summaries;

    public function __construct(array $summaries)
    {
        $this->summaries = $summaries;
    }

    public function array(): array
    {
        return array_map(function ($item) {
            return [
                $item['employee']->id_staff,
                $item['employee']->first_name . ' ' . $item['employee']->last_name,
                $item['summary']['working_days'],
                $item['summary']['total_hours'],
                $item['summary']['ot_1_5_hours'],
                $item['summary']['ot_2_0_hours'],
                $item['summary']['base_salary'],
                $item['summary']['ot_1_5_pay'],
                $item['summary']['ot_2_0_pay'],
                $item['summary']['salary_deduction'],
                $item['summary']['total_salary'],
            ];
        }, $this->summaries);
    }

    public function headings(): array
    {
        return [
            'Staff ID',
            'Name',
            'Working Days',
            'Total Hours',
            'OT 1.5 Hours',
            'OT 2.0 Hours',
            'Base Salary',
            'OT 1.5 Pay',
            'OT 2.0 Pay',
            'Salary Deduction',
            'Total Salary',
        ];
    }
}
