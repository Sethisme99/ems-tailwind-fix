@extends('layouts.app')

@section('title', 'Create Attendance')

@section('content')
    <h3 class="text-xl font-bold text-gray-800 mb-4">Create Attendance</h3>

    <div class="bg-white shadow rounded p-6">
        <form action="{{ route('attendances.store') }}" method="post" class="space-y-4">
            @csrf

            <!-- Date -->
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="date" id="date"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                       value="{{ old('date') }}">
                @error('date')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Check In -->
            <div>
                <label for="check_in" class="block text-sm font-medium text-gray-700">Check In</label>
                <input type="time" name="check_in" id="check_in"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                       value="{{ old('check_in') }}">
                @error('check_in')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Check Out -->
            <div>
                <label for="check_out" class="block text-sm font-medium text-gray-700">Check Out</label>
                <input type="time" name="check_out" id="check_out"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                       value="{{ old('check_out') }}">
                @error('check_out')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Employee Search -->
            <div class="relative max-w-md">
                <label for="employee_search" class="block text-sm font-medium text-gray-700">Employee</label>
                <input type="text" id="employee_search" placeholder="Search employee..."
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                       autocomplete="on">
                <input type="hidden" name="employee_id" id="employee_id">
                <input type="hidden" name="id_staff" id="id_staff">

                <ul id="employee_list"
                    class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow max-h-52 overflow-y-auto hidden text-sm">
                    {{-- Populated by JS --}}
                </ul>
                @error('employee_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-3 pt-4">
                <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm">
                    Save Attendance
                </button>
                <a href="{{ route('attendances.index') }}"
                   class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 text-sm">
                    Cancel
                </a>
            </div>
        </form>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('employee_search');
        const hiddenEmployeeId = document.getElementById('employee_id');
        const hiddenStaffId = document.getElementById('id_staff');
        const employeeList = document.getElementById('employee_list');

        let timeout = null;

        searchInput.addEventListener('input', function () {
            const query = this.value.trim();

            clearTimeout(timeout);
            if (!query) {
                employeeList.classList.add('hidden');
                return;
            }

            timeout = setTimeout(() => {
                fetch(`/api/employees/search?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        employeeList.innerHTML = '';
                        if (data.length === 0) {
                            employeeList.classList.add('hidden');
                            return;
                        }

                        data.forEach(emp => {
                            const item = document.createElement('li');
                            item.className = 'cursor-pointer px-4 py-2 hover:bg-blue-100';
                            item.textContent = `${emp.first_name} ${emp.last_name}`;
                            item.dataset.id = emp.id;
                            item.dataset.staff = emp.id_staff; // include id_staff in the dataset

                            item.addEventListener('click', function () {
                                searchInput.value = this.textContent;
                                hiddenEmployeeId.value = this.dataset.id;
                                hiddenStaffId.value = this.dataset.staff; // set id_staff value
                                employeeList.classList.add('hidden');
                            });

                            employeeList.appendChild(item);
                        });

                        employeeList.classList.remove('hidden');
                    });
            }, 300);
        });

        document.addEventListener('click', function (e) {
            if (!e.target.closest('#employee_list') && e.target !== searchInput) {
                employeeList.classList.add('hidden');
            }
        });
    });
</script>

@endsection
