@extends('layouts.app')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-center flex-wrap mb-6 px-3 py-2 shadow rounded">
    <h3 class="text-xl font-bold text-gray-800 mb-3 md:mb-0">Payslips</h3>
    <a href="{{ route('payslips.create') }}"
        class="inline-flex items-center px-3 py-2 text-sm font-medium shadow  text-white bg-yellow-500 hover:bg-yellow-600 transition rounded">
        <i class="fas fa-plus mr-2"></i> Create Payslips
    </a>
</div>


    <div class="w-full overflow-x-auto">
        <table class="min-w-[1000px] md:min-w-full divide-y divide-gray-200 border border-gray-300 text-sm text-left text-gray-800">
            <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                <tr>
                    <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Id Staff</th>
                    <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Employee</th>
                    <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Month</th>
                    <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Year</th>
                    <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Working Days</th>
                    <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Total Hour</th>
                    <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Base Salary</th>
                    <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">OT 1.5 Pay</th>
                    <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">OT 2.0 Pay</th>
                    <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Deductions</th>
                    <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Total Salary</th>
                    <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payslips as $payslip)
                <tr class=" hover:bg-gray-50">
                    <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">{{ $payslip->employee->id_staff }}</td>
                    <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">{{ $payslip->employee->first_name }} {{ $payslip->employee->last_name }}</td>
                    <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">{{ \Carbon\Carbon::create()->month($payslip->month)->format('F') }}</td>
                    <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">{{ $payslip->year }}</td>
                    <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">{{ $payslip->working_days }}</td>
                    <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">{{ $payslip->total_hours }}</td>

                    <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">${{ number_format($payslip->base_salary, 2) }}</td>
                    <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">${{ number_format($payslip->ot_1_5_pay, 2) }}</td>
                    <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">${{ number_format($payslip->ot_2_0_pay, 2) }}</td>
                    <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300 ">${{ number_format($payslip->deduction, 2) }}</td>
                    <td class="px-4 py-3 text-left whitespace-nowrap border border-gray-300 font-bold text-green-600">${{ number_format($payslip->total_salary, 2) }}</td>
                    <td class="px-4 py-3  border text-left text-gray-900 whitespace-nowrap border-gray-300 space-x-1">
                        <a 
                            href="{{ route('payslips.show', $payslip->id) }}" 
                            class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-3 py-1 rounded-md shadow"
                        >
                            View
                        </a>

                        <form x-data
                            @submit.prevent="if (confirm('Are you sure you want to delete this payslip?')) $el.submit()"
                            action="{{ route('payslips.destroy', $payslip) }}" method="POST"
                            class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center px-2 py-1 text-xs text-white bg-red-600 hover:bg-red-700 rounded"
                                    title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>


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

@endsection
