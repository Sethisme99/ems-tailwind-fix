<?php

namespace App\Imports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\Importable;
use Throwable;
use Illuminate\Support\Facades\Log;
use App\Models\Employee;
use Carbon\Carbon;

class AttendanceImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use Importable;

    public function model(array $row)
    {
        // Check if employee exists
        $employee = Employee::find($row['employee_id']);
        if (!$employee) {
            Log::warning("Skipped row: Employee ID {$row['employee_id']} does not exist.");
            return null; // Skip this row
        }

        // Parse times using Carbon and calculate hours
        try {
            $checkIn = Carbon::parse($row['check_in']);
            $checkOut = Carbon::parse($row['check_out']);
            $totalHoursWorked = $checkIn->floatDiffInHours($checkOut);
        } catch (\Exception $e) {
            Log::error("Error parsing times for employee ID {$row['employee_id']} on {$row['date']}: " . $e->getMessage());
            return null; // Skip problematic row
        }

        return new Attendance([
            'employee_id'        => $row['employee_id'],
            'date'               => $row['date'],
            'check_in'           => $row['check_in'],
            'check_out'          => $row['check_out'],
            'total_hours_worked' => $totalHoursWorked,
        ]);
    }

    public function onError(Throwable $e)
    {
        Log::error('Skipped due to error: ' . $e->getMessage());
    }
}

