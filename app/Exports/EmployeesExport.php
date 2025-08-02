<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Employee::with(['department', 'position'])->get()->map(function ($employee) {
            return [
                $employee->id_staff,
                $employee->first_name,
                $employee->last_name,
                $employee->national_id,
                $employee->nssf_id,
                $employee->phone,
                $employee->place_of_birth,
                $employee->address,
                $employee->date_of_birth,
                $employee->hire_date,
                $employee->image,
                $employee->salary,
                optional($employee->department)->name,
                optional($employee->position)->title,
                $employee->documents_submitted ? '1' : '0',
                $employee->status ? '1' : '0',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Id_Staff',
            'First Name',
            'Last Name',
            'National_Id',
            'Nssf_Id',
            'Phone',
            'Place_Of_Birth',
            'Address',
            'Date of Birth',
            'Hire Date',
            'Image',
            'Salary',
            'Department',
            'Position',
            'Documents_Submitted',
            'Status',
        ];
    }
}


