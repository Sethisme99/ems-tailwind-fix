@extends('layouts.app')

@section('title')
    Edit Employee
@endsection

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Edit Employee</h3>

        <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Id Staff -->
            <div>
                <label for="id_staff" class="block text-sm font-semibold text-gray-700 mb-1">Staff ID</label>
                <input type="text" name="id_staff" id="id_staff"
                    value="{{ old('id_staff', $employee->id_staff) }}"
                    placeholder="Staff ID"
                    class="w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900 placeholder-gray-400
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                        @error('id_staff') border-red-500 ring-red-500 focus:ring-red-500 @enderror" />
                @error('id_staff')
                    <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- First Name -->
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                <input
                    type="text"
                    name="first_name"
                    id="first_name"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 @error('first_name') border-red-500 @enderror"
                    placeholder="First Name"
                    value="{{ old('first_name', $employee->first_name) }}"
                />
                @error('first_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Last Name -->
            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input
                    type="text"
                    name="last_name"
                    id="last_name"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 @error('last_name') border-red-500 @enderror"
                    placeholder="Last Name"
                    value="{{ old('last_name', $employee->last_name) }}"
                />
                @error('last_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- National_ID -->
            <div>
                <label for="national_id" class="block text-sm font-semibold text-gray-700 mb-1">National ID</label>
                <input type="text" name="national_id" id="national_id"
                    value="{{ old('national_id', $employee->national_id) }}"
                    placeholder="National ID"
                    class="w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900 placeholder-gray-400
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                        @error('national_id') border-red-500 ring-red-500 focus:ring-red-500 @enderror" />
                @error('national_id')
                    <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- NSSF_ID -->


            <div>
                <label for="nssf_id" class="block text-sm font-semibold text-gray-700 mb-1">NSSF ID</label>
                <input type="text" name="nssf_id" id="nssf_id"
                    value="{{ old('nssf_id', $employee->nssf_id) }}"
                    placeholder="NSSF ID"
                    class="w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900 placeholder-gray-400
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                        @error('nssf_id') border-red-500 ring-red-500 focus:ring-red-500 @enderror" />
                @error('nssf_id')
                    <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                @enderror
            </div>


            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input
                    type="text"
                    name="phone"
                    id="phone"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 @error('phone') border-red-500 @enderror"
                    placeholder="Phone"
                    value="{{ old('phone', $employee->phone) }}"
                />
                @error('phone')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Birth of Place -->

            <div>
                <label for="place_of_birth" class="block text-sm font-semibold text-gray-700 mb-1">Place of Birth</label>
                <input type="text" name="place_of_birth" id="place_of_birth"
                    value="{{ old('place_of_birth', $employee->place_of_birth) }}"
                    placeholder="Place of Birth"
                    class="w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900 placeholder-gray-400
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                        @error('place_of_birth') border-red-500 ring-red-500 focus:ring-red-500 @enderror" />
                @error('place_of_birth')
                    <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                @enderror
            </div>



            <!-- Address -->
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <input
                    type="text"
                    name="address"
                    id="address"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 @error('address') border-red-500 @enderror"
                    placeholder="Address"
                    value="{{ old('address', $employee->address) }}"
                />
                @error('address')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date of Birth -->
            <div>
                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input
                    type="date"
                    name="date_of_birth"
                    id="date_of_birth"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 @error('date_of_birth') border-red-500 @enderror"
                    value="{{ old('date_of_birth', $employee->date_of_birth) }}"
                />
                @error('date_of_birth')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!--Document submit-->

            <div>
                <label for="documents_submitted" class="block text-sm font-medium text-gray-700">Documents Submitted</label>
                <select
                    name="documents_submitted"
                    id="documents_submitted"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 bg-white focus:ring-blue-500 focus:border-blue-500 @error('documents_submitted') border-red-500 @enderror"
                >
                    <option value="1" {{ old('documents_submitted', $employee->documents_submitted) == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('documents_submitted', $employee->documents_submitted) == '0' ? 'selected' : '' }}>No</option>
                </select>
                @error('documents_submitted')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Hire Date -->
            <div>
                <label for="hire_date" class="block text-sm font-medium text-gray-700">Hire Date</label>
                <input
                    type="date"
                    name="hire_date"
                    id="hire_date"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 @error('hire_date') border-red-500 @enderror"
                    value="{{ old('hire_date', $employee->hire_date) }}"
                />
                @error('hire_date')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Salary -->
            <div>
                <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
                <input
                    type="number"
                    name="salary"
                    id="salary"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 @error('salary') border-red-500 @enderror"
                    placeholder="Salary"
                    value="{{ old('salary', $employee->salary) }}"
                />
                @error('salary')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                <input
                    type="file"
                    name="image"
                    id="image"
                    class="mt-1 block w-full text-sm border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 @error('image') border-red-500 @enderror"
                />
                @error('image')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Preview Image -->
            <div class="mt-2">
                <img src="{{ asset('images/'.$employee->image) }}" alt="{{ $employee->first_name }}" class="w-36 h-36 rounded shadow">
            </div>

            <!-- Department -->
            <div>
                <label for="department_id" class="block text-sm font-medium text-gray-700">Department</label>
                <select
                    name="department_id"
                    id="department_id"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 bg-white focus:ring-blue-500 focus:border-blue-500 @error('department_id') border-red-500 @enderror"
                >
                    <option disabled selected value="">Choose a department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
                @error('department_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Position -->
            <div>
                <label for="position_id" class="block text-sm font-medium text-gray-700">Position</label>
                <select
                    name="position_id"
                    id="position_id"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 bg-white focus:ring-blue-500 focus:border-blue-500 @error('position_id') border-red-500 @enderror"
                >
                    <option disabled selected value="">Choose a position</option>
                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}" {{ old('position_id', $employee->position_id) == $position->id ? 'selected' : '' }}>
                            {{ $position->title }}
                        </option>
                    @endforeach
                </select>
                @error('position_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select
                    name="status"
                    id="status"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 bg-white focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror"
                >
                    <option value="1" {{ old('status', $employee->status) == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $employee->status) == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="flex space-x-3 pt-4">
                <button type="submit" class="px-6 py-2 bg-yellow-500 text-white rounded shadow hover:bg-yellow-600 transition">
                    Update Employee
                </button>
                <a href="{{ route('employees.index') }}" class="px-6 py-2 bg-gray-300 text-gray-800 rounded shadow hover:bg-gray-400 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
