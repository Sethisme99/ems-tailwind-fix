@extends('layouts.app')

@section('title', 'Create Employee')

@section('content')
<div class="max-w-8xl mx-auto py-10 px-6">
    <h3 class="text-3xl font-bold text-gray-900 mb-8">Create Employee</h3>

    <div class="bg-white shadow-lg rounded-lg p-8">
        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Name Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="first_name" class="block text-sm font-semibold text-gray-700 mb-1">First Name</label>
                    <input type="text" name="first_name" id="first_name"
                        value="{{ old('first_name') }}"
                        placeholder="First Name"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900 placeholder-gray-400
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                            @error('first_name') border-red-500 ring-red-500 focus:ring-red-500 @enderror" />
                    @error('first_name')
                        <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="last_name" class="block text-sm font-semibold text-gray-700 mb-1">Last Name</label>
                    <input type="text" name="last_name" id="last_name"
                        value="{{ old('last_name') }}"
                        placeholder="Last Name"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900 placeholder-gray-400
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                            @error('last_name') border-red-500 ring-red-500 focus:ring-red-500 @enderror" />
                    @error('last_name')
                        <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Contact Fields -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email"
                        value="{{ old('email') }}"
                        placeholder="Email"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900 placeholder-gray-400
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                            @error('email') border-red-500 ring-red-500 focus:ring-red-500 @enderror" />
                    @error('email')
                        <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-semibold text-gray-700 mb-1">Phone</label>
                    <input type="text" name="phone" id="phone"
                        value="{{ old('phone') }}"
                        placeholder="Phone"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900 placeholder-gray-400
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                            @error('phone') border-red-500 ring-red-500 focus:ring-red-500 @enderror" />
                    @error('phone')
                        <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="address" class="block text-sm font-semibold text-gray-700 mb-1">Address</label>
                    <input type="text" name="address" id="address"
                        value="{{ old('address') }}"
                        placeholder="Address"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900 placeholder-gray-400
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                            @error('address') border-red-500 ring-red-500 focus:ring-red-500 @enderror" />
                    @error('address')
                        <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Dates -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="date_of_birth" class="block text-sm font-semibold text-gray-700 mb-1">Date of Birth</label>
                    <input type="date" name="date_of_birth" id="date_of_birth"
                        value="{{ old('date_of_birth') }}"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                            @error('date_of_birth') border-red-500 ring-red-500 focus:ring-red-500 @enderror" />
                    @error('date_of_birth')
                        <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="hire_date" class="block text-sm font-semibold text-gray-700 mb-1">Hire Date</label>
                    <input type="date" name="hire_date" id="hire_date"
                        value="{{ old('hire_date') }}"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                            @error('hire_date') border-red-500 ring-red-500 focus:ring-red-500 @enderror" />
                    @error('hire_date')
                        <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Salary and Image -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                <div>
                    <label for="salary" class="block text-sm font-semibold text-gray-700 mb-1">Salary</label>
                    <input type="number" name="salary" id="salary"
                        value="{{ old('salary') }}"
                        placeholder="Salary"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900 placeholder-gray-400
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                            @error('salary') border-red-500 ring-red-500 focus:ring-red-500 @enderror" />
                    @error('salary')
                        <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div x-data="{ previewUrl: null }" class="space-y-2">
                    <label for="image" class="block text-sm font-semibold text-gray-700 mb-1">Image</label>
                    <input
                        type="file"
                        name="image"
                        id="image"
                        @change="previewUrl = URL.createObjectURL($event.target.files[0])"
                        class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded file:border-0
                        file:text-sm file:font-semibold
                        file:bg-blue-50 file:text-blue-700
                        hover:file:bg-blue-100
                        @error('image') border-red-500 @enderror"
                    />
                    <template x-if="previewUrl">
                        <img :src="previewUrl" alt="Image Preview" class="w-24 h-24 rounded object-cover border border-gray-300 mt-2" />
                    </template>
                    @error('image')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Department, Position, Status -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="department_id" class="block text-sm font-semibold text-gray-700 mb-1">Department</label>
                    <select name="department_id" id="department_id"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                            @error('department_id') border-red-500 ring-red-500 focus:ring-red-500 @enderror">
                        <option disabled selected>Choose a department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="position_id" class="block text-sm font-semibold text-gray-700 mb-1">Position</label>
                    <select name="position_id" id="position_id"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                            @error('position_id') border-red-500 ring-red-500 focus:ring-red-500 @enderror">
                        <option disabled selected>Choose a position</option>
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>
                                {{ $position->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('position_id')
                        <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                    <select name="status" id="status"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                            @error('status') border-red-500 ring-red-500 focus:ring-red-500 @enderror">
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex space-x-4 justify-end mt-8">
                <a href="{{ route('employees.index') }}"
                   class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 transition">
                   Cancel
                </a>
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                    Save Employee
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
