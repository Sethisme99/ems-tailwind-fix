@extends('layouts.app')

@section('title')
    Employees
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="my-3">
           
        </h3>
        <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i>
        </a>
    </div>
    <hr>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div
                        class="table-responsive"
                    >
                        <table
                            class="table dataTable table-bordered table-striped table-hover"
                        >
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Date of birth</th>
                                    <th scope="col">Hire Date</th>
                                    <th scope="col">Salary</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection