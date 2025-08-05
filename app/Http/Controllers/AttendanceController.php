<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Imports\AttendanceImport;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::with('employee')->latest()->get();
        return view('attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
     //  $employees = Employee::orderBy('first_name')->limit(100)->get(); // Or paginate
       return view('attendances.create',compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddAttendanceRequest $request)
    {
        $data = $request->validated();

        $exists = Attendance::where([
            'id_staff' => $data['id_staff'],
            'employee_id' => $data['employee_id'],
            'date' => $data['date'],
        ])->exists();

        if ($exists) {
            return to_route('attendances.index')->with('error', 'Attendance for this employee on this date already exists');
        }

        $checkIn = Carbon::parse($data['check_in']);
        $checkOut = Carbon::parse($data['check_out']);
        $data['total_hours_worked'] = $checkIn->floatDiffInHours($checkOut); // accurate to decimal

        Attendance::create($data);

        return to_route('attendances.index')->with('success', 'Attendance created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        $employees = Employee::all();
        return view('attendances.edit',compact('employees','attendance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        $data = $request->validated();

        // Optional: Check for duplicates (but avoid blocking this current record itself)
        $exists = Attendance::where([

            'id_staff' => $data['id_staff'],
            'employee_id' => $data['employee_id'],
            'date' => $data['date'],
        ])->where('id', '!=', $attendance->id)->exists();

        if ($exists) {
            return to_route('attendances.index')->with('error', 'Attendance for this employee on this date already exists');
        }

        // Calculate total hours worked
        $checkIn = Carbon::parse($data['check_in']);
        $checkOut = Carbon::parse($data['check_out']);
        $data['total_hours_worked'] = $checkIn->floatDiffInHours($checkOut); // accurate to decimal

        // Update the existing record
        $attendance->update($data);

        return to_route('attendances.index')->with('success', 'Attendance updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return to_route('attendances.index')->with('success','Attendance deleted successfully');
    }


    //Import and Export to Excel:

    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,csv,xls',
    ]);

    Excel::import(new AttendanceImport, $request->file('file'));

    return back()->with('success', 'Attendance imported successfully!');
}


    public function export()
    {
        return Excel::download(new AttendanceExport, 'attendances.xls');
    }



}
