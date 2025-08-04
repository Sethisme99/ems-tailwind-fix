@extends('layouts.app')

@section('title')
    Employees
@endsection

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-center flex-wrap mb-6 px-3 py-2 shadow rounded">
        <h3 class="text-xl font-bold text-gray-800 mb-3 md:mb-0">Employees ({{ $employees->total() }})</h3>
        <a href="{{ route('employees.create') }}"
           class="inline-flex items-center px-3 py-2 text-sm font-medium shadow  text-white bg-yellow-500 hover:bg-yellow-600 transition rounded">
            <i class="fas fa-plus mr-2"></i> Add Employee
        </a>
    </div>
    <!--search and excel import-->
        <div class="flex flex-col md:flex-row justify-between items-center flex-wrap mb-6">
            <!--Search Form start-->
                <form method="GET" action="{{ route('employees.index') }}" class="mb-4 flex flex-col sm:flex-row items-center gap-2">
                    <input
                        type="text"
                        name="q"
                        placeholder="Search by Staff ID or Name"
                        value="{{ request('q') }}"
                        class="w-full sm:w-60 px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    />

                    <button type="submit"
                        class="inline-flex items-center gap-1 px-3 py-2 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded shadow cursor-pointer">
                        <i class="fas fa-search"></i>
                        Search
                    </button>

                    <a href="{{ route('employees.index') }}"
                        class="inline-flex items-center gap-1 px-3 py-2 text-sm text-gray-700 bg-gray-200 hover:bg-gray-300 rounded shadow">
                        Reset
                    </a>
                </form>
            <!--Search Form end-->
            <!-- Import Excel -->
                <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data"
                    class="flex flex-col sm:flex-row items-center gap-2 mb-6">
                    @csrf
                    <input
                        type="file"
                        name="file"
                        required
                        class="block w-full sm:w-auto text-sm text-gray-700 border border-gray-300 rounded-md shadow-sm file:mr-3 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:bg-green-100 file:text-green-700 hover:file:bg-green-200"
                    >
                    <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded shadow cursor-pointer">
                        Import Excel
                    </button>
                </form>
            <!-- Import Excel end-->
        </div>
    <!--search and excel import end-->
 
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
                <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                    <tr>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">ID</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">ID_Staff</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Name</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">National_ID</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">NSSF_ID</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Phone</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Place Of Birth</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Address</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Date of Birth</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Hire Date</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Salary</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Image</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Department</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Position</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Documents Submitted</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300">Status</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap border border-gray-300 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($employees as $key => $employee)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">{{ $employees->firstItem() + $key }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">{{ $employee->id_staff }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">{{ $employee->national_id }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">{{ $employee->nssf_id }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">{{ $employee->phone }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">{{ $employee->place_of_birth }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">{{ $employee->address }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">{{ $employee->date_of_birth }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">{{ $employee->hire_date }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">{{ $employee->salary }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">
                            <img src="{{ asset('images/'.$employee->image) }}"
                                alt="{{ $employee->first_name }}"
                                class="w-11 h-11 rounded object-cover border">
                        </td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">{{ $employee->department->name }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">{{ $employee->position->title }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded
                                {{ $employee->documents_submitted ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $employee->documents_submitted ? 'Yes' : 'No' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded
                                {{ $employee->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $employee->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap border border-gray-300 space-x-1">
                            <a href="{{ route('employees.show', $employee->id) }}"
                            class="inline-flex items-center px-2 py-1 text-xs text-white bg-gray-800 hover:bg-gray-700 rounded"
                            title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('employees.edit', $employee->id) }}"
                            class="inline-flex items-center px-2 py-1 text-xs text-white bg-yellow-500 hover:bg-yellow-600 rounded"
                            title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form x-data
                                @submit.prevent="if (confirm('Are you sure you want to delete this employee?')) $el.submit()"
                                action="{{ route('employees.destroy', $employee->id) }}" method="POST"
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
                    <tr>
                        <td colspan="17" class="text-center py-4 text-gray-500">No employees found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination and Export -->
        <div class="mt-3">
            {{ $employees->appends(request()->query())->links() }}
        </div>
    </div>


    <!-- Export Button -->
    <div class="mt-4">
        <a href="{{ route('employees.export') }}"
            class="inline-flex items-center px-4 py-2 text-sm text-blue-700 border border-blue-500 rounded hover:bg-blue-50">
            <i class="fas fa-download mr-2"></i> Download Excel
        </a>
    </div>

@endsection

