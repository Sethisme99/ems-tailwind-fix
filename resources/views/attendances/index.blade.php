@extends('layouts.app')

@section('title', 'Attendances')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-2 mb-6">
        <h3 class="text-xl font-bold text-gray-800">Attendances ({{ $attendances->count() }})</h3>
        <a href="{{ route('attendances.create') }}"
           class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded shadow">
            <i class="fas fa-plus mr-1"></i> Add Attendance
        </a>
    </div>

    <!-- Import Excel -->
    <form action="{{route('attendances.import')}}" method="POST" enctype="multipart/form-data"
          class="flex flex-col sm:flex-row items-center gap-2 mb-6">
        @csrf
        <input
            type="file"
            name="file"
            required
            class="block w-full sm:w-auto text-sm text-gray-700 border border-gray-300 rounded-md shadow-sm file:mr-3 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:bg-green-100 file:text-green-700 hover:file:bg-green-200"
        >
        <button type="submit"
                class="px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded shadow">
            Import Excel
        </button>
    </form>

    <!-- Table -->
    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left text-gray-800">
            <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">ID_Staff</th>
                    <th class="px-4 py-3">Employee Name</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Check In</th>
                    <th class="px-4 py-3">Check Out</th>
                    <th class="px-4 py-3">Total Hours</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($attendances as $attendance)
                    <tr>
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $attendance->employee->id_staff }}</td>
                        <td class="px-4 py-3">
                            {{ $attendance->employee->first_name }} {{ $attendance->employee->last_name }}
                        </td>
                        <td class="px-4 py-3">{{ $attendance->date }}</td>
                        <td class="px-4 py-3">{{ $attendance->check_in }}</td>
                        <td class="px-4 py-3">{{ $attendance->check_out }}</td>
                        <td class="px-4 py-3">{{ $attendance->total_hours_worked }}</td>
                        <td class="px-4 py-3 text-center space-x-1">
                            <a href="{{ route('attendances.edit', $attendance->id) }}"
                               class="inline-flex items-center justify-center px-2 py-1 text-xs text-white bg-yellow-500 hover:bg-yellow-600 rounded"
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('attendances.destroy', $attendance->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this attendance?')"
                                  class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center justify-center px-2 py-1 text-xs text-white bg-red-600 hover:bg-red-700 rounded"
                                        title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Export Button -->
    <div class="mt-4">
        <a href="{{route('attendances.export')}}"
           class="inline-flex items-center px-4 py-2 text-sm text-blue-700 border border-blue-500 rounded hover:bg-blue-50">
            <i class="fas fa-download mr-2"></i> Download Excel
        </a>
    </div>
@endsection
