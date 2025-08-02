<?php
namespace App\Imports;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EmployeesImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        $department = Department::where('name', $row['department'])->first();
        $position   = Position::where('title', $row['position'])->first();

        // Optional: skip rows with missing mapping
        if (!$department || !$position) {
            return null; // skip this row
        }

        return new Employee([
            'id_staff'      => $row['id_staff'],
            'first_name'    => $row['first_name'],
            'last_name'     => $row['last_name'],
            'national_id'   => $row['national_id'],
            'nssf_id'       => $row['nssf_id'],
            'phone'         => $row['phone'],
            'place_of_birth'=> $row['place_of_birth'],
            'address'       => $row['address'],
            'date_of_birth' => $row['date_of_birth'],
            'hire_date'     => $row['hire_date'],
            'salary'        => $row['salary'],
            'image'         => $row['image'],
            'department_id' => $department->id,
            'position_id'   => $position->id,
            'documents_submitted'  => $this->convertYesNo($row['documents_submitted']),
            'status'               => $this->convertStatus($row['status']),
        ]);
    }



    public function rules(): array
{
    return [
        '*.id_staff' => ['required'],
        '*.documents_submitted' => ['required', 'in:Yes,No,yes,no,1,0'],
        '*.status' => ['required', 'in:Active,Inactive,active,inactive,1,0'],
        /*
        '*.first_name' => ['required'],
        '*.last_name' => ['required'],
        '*.email' => ['required', 'email', 'unique:employees,email'],
        '*.department' => ['required', 'exists:departments,name'],
        '*.position' => ['required', 'exists:positions,title'],*/
    ];
}

private function convertYesNo($value): int
{
    $value = strtolower(trim((string) $value));

    return in_array($value, ['yes', '1', 'true'], true) ? 1 : 0;
}

private function convertStatus($value): int
{
    $value = strtolower(trim((string) $value));

    return in_array($value, ['active', '1', 'true'], true) ? 1 : 0;
}
}
