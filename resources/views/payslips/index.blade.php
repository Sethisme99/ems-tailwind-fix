@extends('layouts.app')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-center flex-wrap mb-6 px-3 py-2 shadow rounded">
    <h3 class="text-xl font-bold text-gray-800 mb-3 md:mb-0">Payslips</h3>
    <a href="{{ route('payslips.create') }}"
        class="inline-flex items-center px-3 py-2 text-sm font-medium shadow  text-white bg-yellow-500 hover:bg-yellow-600 transition rounded">
        <i class="fas fa-plus mr-2"></i> Create Payslips
    </a>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm text-gray-800">
            <thead class="bg-gray-100 text-xs uppercase tracking-wider text-gray-600">
                <tr>
                    <th class="px-4 py-3 text-left">Employee</th>
                    <th class="px-4 py-3 text-left">Month</th>
                    <th class="px-4 py-3 text-left">Year</th>
                    <th class="px-4 py-3 text-left">Base Salary</th>
                    <th class="px-4 py-3 text-left">OT 1.5 Pay</th>
                    <th class="px-4 py-3 text-left">OT 2.0 Pay</th>
                    <th class="px-4 py-3 text-left">Deductions</th>
                    <th class="px-4 py-3 text-left">Total Salary</th>
                    <th class="px-4 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payslips as $payslip)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $payslip->employee->first_name }} {{ $payslip->employee->last_name }}</td>
                    <td class="px-4 py-3">{{ \Carbon\Carbon::create()->month($payslip->month)->format('F') }}</td>
                    <td class="px-4 py-3">{{ $payslip->year }}</td>
                    <td class="px-4 py-3">${{ number_format($payslip->base_salary, 2) }}</td>
                    <td class="px-4 py-3">${{ number_format($payslip->ot_1_5_pay, 2) }}</td>
                    <td class="px-4 py-3">${{ number_format($payslip->ot_2_0_pay, 2) }}</td>
                    <td class="px-4 py-3 text-red-600">${{ number_format($payslip->deduction, 2) }}</td>
                    <td class="px-4 py-3 font-bold text-green-600">${{ number_format($payslip->total_salary, 2) }}</td>
                    <td class="px-4 py-3">
                        <a 
                            href="{{ route('payslips.show', $payslip->id) }}" 
                            class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-3 py-1 rounded-md shadow"
                        >
                            View
                        </a>
                    </td>
                </tr>
                @empty
                <tr class="border-t">
                    <td colspan="9" class="px-4 py-6 text-center text-gray-500">No payslips available.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
