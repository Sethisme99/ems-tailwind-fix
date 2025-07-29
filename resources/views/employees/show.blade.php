@extends('layouts.app')

@section('title')
    Employee CV - {{ $employee->first_name }} {{ $employee->last_name }}
@endsection

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h3 class="text-2xl font-extrabold text-gray-800">
            Employee CV : {{ $employee->id_staff }}
        </h3>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 max-w-5xl mx-auto">
        <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-8 mb-8">
            <img src="{{ asset('images/'.$employee->image) }}"
                 alt="{{ $employee->first_name }}"
                 class="rounded-lg w-48 h-48 object-cover shadow" />
            <div class="text-center md:text-left">
                <h1 class="text-3xl font-bold text-gray-900">
                {{ $employee->first_name }} {{ $employee->last_name }}
                </h1>
            </div>
        </div>

        <div class="space-y-6">
            <!-- Personal Information -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
                    Personal Information
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-gray-700">
                    <div><strong>ID Staff:</strong> {{ $employee->id_staff }}</div>
                    <div><strong>First Name:</strong> {{ $employee->first_name }}</div>
                    <div><strong>Last Name:</strong> {{ $employee->last_name }}</div>
                    <div><strong>NSSF ID:</strong> {{ $employee->nssf_id }}</div>
                    <div><strong>National ID:</strong> {{ $employee->national_id }}</div>
                    <div><strong>Phone:</strong> {{ $employee->phone }}</div>
                    <div><strong>Place Of Birth:</strong> {{ $employee->place_of_birth }}</div>
                    <div><strong>Address:</strong> {{ $employee->address }}</div>
                    <div><strong>Date of Birth:</strong> {{ $employee->date_of_birth }}</div>
                </div>
            </div>

            <!-- Company Information -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
                    Company Information
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700">
                    <div><strong>Hire Date:</strong> {{ $employee->hire_date }}</div>
                    <div><strong>Salary:</strong> {{ $employee->salary }}</div>
                    <div><strong>Department:</strong> {{ $employee->department->name }}</div>
                    <div><strong>Position:</strong> {{ $employee->position->title }}</div>
                    <div><strong>Documents Submitted:</strong> {{ $employee->documents_submitted ? 'Yes' : 'No' }}</div>
                    <div><strong>Status:</strong> {{ $employee->status ? 'Active' : 'Inactive' }}</div>
                </div>
            </div>

            <!-- Download PDF -->
            <div class="text-right mt-6">
                <a href="#"
                   class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded hover:bg-gray-700 transition">
                    <i class="fas fa-download mr-2"></i>
                    Download as PDF
                </a>
            </div>
        </div>
    </div>
@endsection
