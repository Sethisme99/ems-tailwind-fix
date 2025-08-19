<?php
namespace App\Services;

use App\Models\Payslip;
use App\Models\Employee;
use App\Services\AttendanceSummaryService;

class PayslipGeneratorService
{
    protected $attendanceSummaryService;

    public function __construct(AttendanceSummaryService $attendanceSummaryService)
    {
        $this->attendanceSummaryService = $attendanceSummaryService;
    }

    public function generatePayslip($employeeId, $month, $year)
    {
        // Check for existing payslip
        if (Payslip::where('employee_id', $employeeId)
            ->where('month', $month)
            ->where('year', $year)
            ->exists()) {
            return ['status' => 'error', 'message' => 'Payslip already exists for this employee and month'];
        }

        $summary = $this->attendanceSummaryService->getMonthlySummary($employeeId, $month, $year);

        // Create payslip 
        return Payslip::create([
            'employee_id'   => $employeeId,
            'month'         => $month,
            'year'          => $year,
            'working_days'  => $summary['working_days'],
            'total_hours'   => $summary['total_hours'],
            'base_salary'   => $summary['base_salary'],
            'ot_1_5_hours'  => $summary['ot_1_5_hours'],
            'ot_2_0_hours'  => $summary['ot_2_0_hours'],
            'ot_1_5_pay'    => $summary['ot_1_5_pay'],
            'ot_2_0_pay'    => $summary['ot_2_0_pay'],
            'deduction'     => $summary['salary_deduction'],
            'total_salary'  => $summary['total_salary'],
        ]);
    }
}
