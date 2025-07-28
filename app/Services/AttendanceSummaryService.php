<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\Holiday;
use App\Models\Employee;
use Carbon\Carbon;

class AttendanceSummaryService
{
    public function getMonthlySummary($employeeId, $month, $year)
    {
        $employee = Employee::findOrFail($employeeId);
        $baseSalary = $employee->salary;

        // Settings
        $expectedWorkingDays = 26;
        $standardMonthlyHours = $expectedWorkingDays * 8; // 208 hours
        $hourlyRate = $baseSalary / $standardMonthlyHours;
        $dailyRate = $baseSalary / $expectedWorkingDays;

        // Summary structure
        $summary = [
            'working_days'      => 0,
            'total_hours'       => 0,
            'ot_1_5_hours'      => 0,
            'ot_2_0_hours'      => 0,
            'base_salary'       => round($baseSalary, 2),
            'ot_1_5_pay'        => 0,
            'ot_2_0_pay'        => 0,
            'salary_deduction'  => 0,
            'total_salary'      => 0,
        ];

        // Date range
        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate   = Carbon::create($year, $month, 1)->endOfMonth();

        // Get attendances and holidays
        $attendances = Attendance::where('employee_id', $employeeId)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        $holidays = Holiday::whereBetween('date', [$startDate, $endDate])
            ->pluck('date')
            ->toArray();

        // Loop through attendances
        foreach ($attendances as $attendance) {
            $day = Carbon::parse($attendance->date);
            $workedHours = $attendance->total_hours_worked ?? 0;

            $summary['working_days']++;
            $summary['total_hours'] += $workedHours;

            // OT 2.0x on Sunday or official holidays
            if ($day->isSunday() || in_array($attendance->date, $holidays)) {
                $summary['ot_2_0_hours'] += $workedHours;
            }

            // OT 1.5x on normal workdays when working over 8 hrs
            elseif ($workedHours > 8) {
                $summary['ot_1_5_hours'] += $workedHours - 8;
            }
        }

        // Calculate pay
        $summary['ot_1_5_pay'] = round($hourlyRate * 1.5 * $summary['ot_1_5_hours'], 2);
        $summary['ot_2_0_pay'] = round($hourlyRate * 2.0 * $summary['ot_2_0_hours'], 2);

        // Deduction for absence
        $daysAbsent = max(0, $expectedWorkingDays - $summary['working_days']);
        $summary['salary_deduction'] = round($dailyRate * $daysAbsent, 2);

        // Final salary
        $summary['total_salary'] = round(
            ($baseSalary - $summary['salary_deduction']) +
            $summary['ot_1_5_pay'] +
            $summary['ot_2_0_pay'],
            2
        );

        return $summary;
    }
}
