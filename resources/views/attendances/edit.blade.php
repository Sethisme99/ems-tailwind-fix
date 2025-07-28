@extends('layouts.app')

@section('title', 'Edit Attendance')

@section('content')
    <h3 class="text-xl font-bold text-gray-800 mb-4">Edit Attendance</h3>

    <div class="bg-white shadow rounded p-6">
        <form action="{{ route('attendances.update', $attendance->id) }}" method="POST" class="space-y-5">
            @csrf
            @method("PUT")

            <!-- Date -->
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input
                    type="date"
                    name="date"
                    id="date"
                    value="{{ old('date', $attendance->date) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                />
                @error('date')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Check In -->
            <div>
                <label for="check_in" class="block text-sm font-medium text-gray-700">Check In</label>
                <input
                    type="time"
                    name="check_in"
                    id="check_in"
                    value="{{ old('check_in', $attendance->check_in) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                />
                @error('check_in')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Check Out -->
            <div>
                <label for="check_out" class="block text-sm font-medium text-gray-700">Check Out</label>
                <input
                    type="time"
                    name="check_out"
                    id="check_out"
                    value="{{ old('check_out', $attendance->check_out) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                />
                @error('check_out')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Employee -->
            <div>
                <label for="employee_id" class="block text-sm font-medium text-gray-700">Employee</label>
                <select
                    name="employee_id"
                    id="employee_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                >
                    <option selected disabled value="">Choose an employee</option>
                    @foreach ($employees as $employee)
                        <option
                            value="{{ $employee->id }}"
                            {{ old('employee_id', $attendance->employee_id) == $employee->id ? 'selected' : '' }}>
                            {{ $employee->first_name }} {{ $employee->last_name }}
                        </option>
                    @endforeach
                </select>
                @error('employee_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white text-sm rounded hover:bg-green-700 transition">
                    Update Attendance
                </button>
                <a href="{{ route('attendances.index') }}"
                   class="px-4 py-2 bg-gray-300 text-gray-800 text-sm rounded hover:bg-gray-400 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
