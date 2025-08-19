<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceSummaryController;



Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('employees',EmployeeController::class);
Route::get('/api/employees/search', [App\Http\Controllers\EmployeeController::class, 'search']);

//Attendance Routes:
//Route::resource('attendances',AttendanceController::class)->except(['show']);
Route::resource('attendances', AttendanceController::class);


Route::get('/api/employees/search', [App\Http\Controllers\EmployeeController::class, 'search']);
Route::post('/attendances/import', [AttendanceController::class, 'import'])->name('attendances.import');
Route::get('/attendances/export', [AttendanceController::class, 'export'])->name('attendances.export');
Route::get('/attendance-summary', [AttendanceSummaryController::class, 'index'])->name('attendance.summary');
//Payslip:
Route::resource('payslips', \App\Http\Controllers\PayslipController::class);
Route::get('/payslips/{payslip}', [\App\Http\Controllers\PayslipController::class, 'showPayslip'])->name('payslips.show');
Route::delete('/payslips/{payslip}', [\App\Http\Controllers\PayslipController::class, 'destroy'])->name('payslips.destroy');



//Import and Export to Excel and PDF:

Route::get('/export-summary/all', [AttendanceSummaryController::class, 'exportAllSummaries'])
    ->name('attendances.exportAllSummaries');

Route::post('/employees/import', [EmployeeController::class, 'import'])->name('employees.import');
Route::get('/employees/export/excel', [EmployeeController::class, 'exportAll'])->name('employees.export');
