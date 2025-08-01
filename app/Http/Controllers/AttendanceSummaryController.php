<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Services\AttendanceSummaryService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class AttendanceSummaryController extends Controller
{
    protected $summaryService;

    public function __construct(AttendanceSummaryService $summaryService)
    {
        $this->summaryService = $summaryService;
    }


public function index(Request $request)
{
    $month = $request->input('month', now()->month);
    $year = $request->input('year', now()->year);
    $search = $request->input('q');

    // Build query with optional search
    $query = Employee::query();

    if ($request->filled('q')) {
        $q = $request->q;

        $query->where(function ($subQuery) use ($q) {
            $subQuery->where('id_staff', 'like', "%$q%")
                     ->orWhere('first_name', 'like', "%$q%")
                     ->orWhere('last_name', 'like', "%$q%")
                     ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%$q%");
        });
    }

    $employeesPaginator = $query->paginate(20);
    $summaries = [];

    foreach ($employeesPaginator as $employee) {
        $summaries[] = [
            'employee' => $employee,
            'summary' => $this->summaryService->getMonthlySummary($employee->id, $month, $year),
        ];
    }

    $summaries = new LengthAwarePaginator(
        $summaries,
        $employeesPaginator->total(),
        $employeesPaginator->perPage(),
        $employeesPaginator->currentPage(),
        [
            'path' => request()->url(),
            'query' => request()->query(),
        ]
    );


    return view('attendances.monthly_summary', compact('summaries', 'month', 'year', 'search'));
}
}
