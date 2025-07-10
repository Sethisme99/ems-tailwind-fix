<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('employees',EmployeeController::class);

