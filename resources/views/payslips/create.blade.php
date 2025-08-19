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
