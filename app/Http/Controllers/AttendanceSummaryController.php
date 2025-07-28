<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Services\AttendanceSummaryService;
use Illuminate\Http\Request;

class AttendanceSummaryController extends Controller
{
    protected $summaryService;

    public function __construct(AttendanceSummaryService $summaryService)
    {
        $this->summaryService = $summaryService;
    }

    public function index(Request $request)
    {
        $employees = Employee::all();
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);
        $summaries = [];

        foreach ($employees as $employee) {
            $summaries[] = [
                'employee' => $employee,
                'summary' => $this->summaryService->getMonthlySummary($employee->id, $month, $year),
            ];
        }

        return view('attendances.monthly_summary', compact('summaries', 'month', 'year'));
    }
}
