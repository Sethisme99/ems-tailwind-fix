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
Route::resource('attendances',AttendanceController::class)->except(['show']);
Route::get('/api/employees/search', [App\Http\Controllers\EmployeeController::class, 'search']);
Route::post('/attendances/import', [AttendanceController::class, 'import'])->name('attendances.import');
Route::get('/attendances/export', [AttendanceController::class, 'export'])->name('attendances.export');
Route::get('/attendance-summary', [AttendanceSummaryController::class, 'index'])->name('attendance.summary');
//Payslip:
Route::resource('payslips', \App\Http\Controllers\PayslipController::class);