@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Generate Payslip</h2>

    @if(session('error'))
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('payslips.store') }}" method="POST" class="space-y-6 bg-white p-6 rounded-lg shadow">
        @csrf

        <!-- Employee Selection -->
        <div>
            <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-1">Employee</label>
            <select 
                name="employee_id" 
                id="employee_id" 
                required 
                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="">Select Employee</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">
                        {{ $employee->first_name }} {{ $employee->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Month Selection -->
        <div>
            <label for="month" class="block text-sm font-medium text-gray-700 mb-1">Month</label>
            <select 
                name="month" 
                id="month" 
                required 
                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}">{{ \Carbon\Carbon::create()->month($i)->format('F') }}</option>
                @endfor
            </select>
        </div>

        <!-- Year Input -->
        <div>
            <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Year</label>
            <input 
                type="number" 
                name="year" 
                id="year" 
                value="{{ now()->year }}" 
                required 
                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <!-- Submit Button -->
        <div>
            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white font-semibold text-sm px-4 py-2 rounded-md hover:bg-blue-700 transition"
            >
                Generate Payslip
            </button>
        </div>
    </form>
</div>
@endsection
