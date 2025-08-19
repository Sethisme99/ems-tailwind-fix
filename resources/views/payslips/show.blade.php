@extends('layouts.app')

@section('title')
    Employee Payslip - {{ $payslip->employee->first_name }} {{ $payslip->employee->last_name }}
@endsection

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h3 class="text-2xl font-extrabold text-gray-800">
            Employee Payslip : {{ $payslip->employee->id_staff }}
        </h3>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 max-w-5xl mx-auto">
        <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-8 mb-8">
            <img src="{{ asset('images/'.$payslip->employee->image) }}"
                 alt="{{ $payslip->employee->first_name }}"
                 class="rounded-lg w-48 h-48 object-cover shadow" />
            <div class="text-center md:text-left">
                <h1 class="text-3xl font-bold text-gray-900">
                {{ $payslip->employee->first_name }} {{ $payslip->employee->last_name }}
                </h1>
            </div>
        </div>

        <div class="space-y-6">
            <!-- Personal Information -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
                    Personal Information
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-1 gap-6 text-gray-700">
                    <div><strong>ID Staff:</strong> {{ $payslip->employee->id_staff }}</div>
                    <div><strong>Name:</strong> {{ $payslip->employee->first_name }} {{ $payslip->employee->last_name }}</div>
                </div>
            </div>

            <!-- Company Information -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
                    Payslip
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-gray-700">
                    
                    <div><strong>Month:</strong> {{ $payslip->month }}</div>
                    <div><strong>Year:</strong> {{ $payslip->year }}</div>
                    <div><strong>Base Salary:</strong> {{ $payslip->base_salary }}</div>

                    <div>
                    <div><strong>Work Days:</strong> {{ $payslip->working_days }}</div>
                    <div><strong>Total Hours:</strong> {{ $payslip->total_hours }}</div>
                    <div><strong>OT 1.5 Hours:</strong> {{ $payslip->ot_1_5_hours }}</div>
                    <div><strong>OT 1.5 Hours Pay:</strong> {{ $payslip->ot_1_5_pay }}</div>
                    </div>
                    <div>
                    <div><strong>OT 2.0 Hours:</strong> {{ $payslip->ot_2_0_hours }}</div>
                    <div><strong>OT 2.0 Hours Pay:</strong> {{ $payslip->ot_2_0_pay }}</div>
                    </div>

                    <div>
                    <div><strong>Salary Deduction:</strong> {{ $payslip->deduction }}</div>
                    <div><strong>Total Salary:</strong> {{ $payslip->total_salary }}</div>
                    </div>

                    <div>
                    <div><strong>Created at:</strong> {{ $payslip->created_at }}</div>
                    <div><strong>Updated_at:</strong> {{ $payslip->updated_at }}</div>
                    </div>

                </div>
            </div>

            <!-- Download PDF -->
            <div class="text-right mt-6">
                <a href="#"
                   class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded hover:bg-gray-700 transition">
                    <i class="fas fa-download mr-2"></i>
                    Download as PDF
                </a>
            </div>
        </div>
    </div>
@endsection
