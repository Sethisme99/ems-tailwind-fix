@extends('layouts.app')

@section('title')
    Employees
@endsection

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-center flex-wrap mb-6">
        <h3 class="text-xl font-bold text-gray-800 mb-3 md:mb-0">Employees</h3>
        <a href="{{ route('employees.create') }}"
           class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded">
            <i class="fas fa-plus mr-2"></i> Add Employee
        </a>
    </div>

    <div class="bg-white shadow rounded overflow-hidden"">
        <div class="w-full overflow-x-auto">
            <table class="min-w-[1000px] md:min-w-full divide-y divide-gray-200 text-sm text-left text-gray-800">
                <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                    <tr>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap">ID</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap">Name</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap">Email</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap">Phone</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap">Address</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap">Date of Birth</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap">Hire Date</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap">Salary</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap">Image</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap">Department</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap">Position</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap">Status</th>
                        <th class="px-4 py-3 text-gray-900 whitespace-nowrap text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse ($employees as $key => $employee)
                    <tr>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap">{{ $employees->firstItem() + $key }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap">{{ $employee->email }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap">{{ $employee->phone }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap">{{ $employee->address }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap">{{ $employee->date_of_birth }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap">{{ $employee->hire_date }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap">{{ $employee->salary }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap">
                            <img src="{{ asset('images/'.$employee->image) }}"
                                    alt="{{ $employee->first_name }}"
                                    class="w-11 h-11 rounded object-cover border">
                        </td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap">{{ $employee->department->name }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap">{{ $employee->position->title }}</td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded
                                {{ $employee->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $employee->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-left text-gray-900 whitespace-nowrap">
                            <a href="{{ route('employees.show', $employee->id) }}"
                                class="inline-flex items-start justify-center px-2 py-1 text-xs text-white bg-gray-800 hover:bg-gray-700 rounded"
                                title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('employees.edit', $employee->id) }}"
                                class="inline-flex items-start justify-center px-2 py-1 text-xs text-white bg-yellow-500 hover:bg-yellow-600 rounded"
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
                                        class="inline-flex items-start justify-center px-2 py-1 text-xs text-white bg-red-600 hover:bg-red-700 rounded"
                                        title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="13" class="text-center">No employees found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination and Export -->
            <div class="mt-3 d-flex justify-content-between align-items-center">
                {{ $employees->appends(request()->query())->links() }}
            </div>
    </div>

@endsection

