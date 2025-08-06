@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        Monthly Attendance Summary ({{ $month }}/{{ $year }})
    </h2>


<form method="GET" class="mb-6">
    <div class="flex flex-wrap items-end gap-5">
        <!-- Search Input -->
        <div>
            <label class="block text-xs text-gray-500 mb-1" for="q">Search</label>
            <input 
                type="text" 
                name="q" 
                id="q"
                class="w-64 px-3 py-1.5 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Search by ID or Name"
                value="{{ request('q') }}"
            >
        </div>

        <!-- Month -->
        <div>
            <label class="block text-xs text-gray-500 mb-1" for="month">Month</label>
            <input 
                type="number" 
                name="month" 
                id="month"
                class="w-24 px-3 py-1.5 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-blue-500"
                placeholder="MM"
                value="{{ $month }}"
            >
        </div>

        <!-- Year -->
        <div>
            <label class="block text-xs text-gray-500 mb-1" for="year">Year</label>
            <input 
                type="number" 
                name="year" 
                id="year"
                class="w-28 px-3 py-1.5 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-blue-500"
                placeholder="YYYY"
                value="{{ $year }}"
            >
        </div>

        <!-- Submit -->
        <div>
            <label class="block text-xs text-transparent mb-1">Filter</label>
            <button 
                type="submit" 
                class="inline-flex items-center px-3 py-1.5 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded shadow"
            >
                🔍 Filter
            </button>
        </div>
    </div>
</form>


    <div x-data="{ scroll: null }" class="bg-white overflow-hidden">
    <!-- Arrow Buttons (Top of the Table) -->
    <div class="flex justify-end gap-2 px-4 py-2">
        <button
            @click="scroll.scrollBy({ left: -300, behavior: 'smooth' })"
            class="bg-gray-200 hover:bg-blue-300 text-gray-800 px-3 py-1 rounded shadow text-sm cursor-pointer"
        >
            &larr; Back
        </button>

        <button
            @click="scroll.scrollBy({ left: 300, behavior: 'smooth' })"
            class="bg-gray-200 hover:bg-blue-300 text-gray-800 px-3 py-1 rounded shadow text-sm cursor-pointer"
        >
            Forward &rarr;
        </button>
    </div>
        <!-- Scrollable Table -->
        <div x-ref="scrollContainer" x-init="scroll = $refs.scrollContainer" class="w-full overflow-x-auto">
            <table class="min-w-[1000px] md:min-w-full divide-y divide-gray-200 border border-gray-300 text-sm text-left text-gray-800">
                <thead class="bg-gray-100 text-xs uppercase tracking-wider text-gray-600">
                    <tr>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Staff_ID</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Name</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Days Worked</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Total Hours</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">OT @ 1.5x</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">OT @ 2.0x</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Base Salary</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">OT 1.5 Pay</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">OT 2.0 Pay</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Deduction</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Total Salary</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($summaries as $data)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-3 font-bold text-left text-blue-600 whitespace-nowrap border border-gray-300">{{ $data['employee']->id_staff }}</td>
                        <td class="px-4 py-3 font-bold text-left text-gray-900 whitespace-nowrap border border-gray-300">{{ $data['employee']->first_name }} {{ $data['employee']->last_name }}</td>
                        <td class="px-4 py-3 font-bold text-left text-red-900 whitespace-nowrap border border-gray-300">{{ $data['summary']['working_days'] }}</td>
                        <td class="px-4 py-3 font-bold text-left text-green-900 whitespace-nowrap border border-gray-300">{{ number_format($data['summary']['total_hours'], 2) }}</td>
                        <td class="px-4 py-3 font-bold text-left text-green-900 whitespace-nowrap border border-gray-300">{{ number_format($data['summary']['ot_1_5_hours'], 2) }}</td>
                        <td class="px-4 py-3 font-bold text-left text-green-900 whitespace-nowrap border border-gray-300">{{ number_format($data['summary']['ot_2_0_hours'], 2) }}</td>
                        <td class="px-4 py-3 font-bold text-left text-green-600 whitespace-nowrap border border-gray-300">${{ number_format($data['summary']['base_salary'], 2) }}</td>
                        <td class="px-4 py-3 font-bold text-left text-green-600 whitespace-nowrap border border-gray-300">${{ number_format($data['summary']['ot_1_5_pay'], 2) }}</td>
                        <td class="px-4 py-3 font-bold text-left text-green-600 whitespace-nowrap border border-gray-300">${{ number_format($data['summary']['ot_2_0_pay'], 2) }}</td>
                        <td class="px-4 py-3 font-bold text-left text-red-900 whitespace-nowrap border border-gray-300">${{ number_format($data['summary']['salary_deduction'], 2) }}</td>
                        <td class="px-4 py-3 font-bold text-green-600 text-left whitespace-nowrap border border-gray-300">${{ number_format($data['summary']['total_salary'], 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Pagination and Export -->
    <div class="mt-3 d-flex justify-content-between align-items-center">
        {{ $summaries->appends(request()->query())->links() }}
    </div>
</div>
<!-- Export Button -->
<div class="mt-4">
    <a href="{{ route('attendances.exportAllSummaries', ['month' => $month, 'year' => $year]) }}"
        class="inline-flex items-center px-4 py-2 text-sm text-blue-700 border border-blue-500 rounded hover:bg-blue-50">
        <i class="fas fa-download mr-2"></i> Download Excel
    </a>
</div>
@endsection
