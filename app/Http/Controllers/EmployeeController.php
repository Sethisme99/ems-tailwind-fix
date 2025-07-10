<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\Department;
use App\Http\Requests\AddEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;



class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee = Employee::all();
        return view('employees.index', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.create',compact('departments','positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddEmployeeRequest $request)
    {
        //
        $data = $request->validate();
        $data['image'] = $this->saveImage($request->file('image'));
        Employee::create($data);
        return to_route('employees.index')->with('success', 'Employee created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.edit', compact('departments', 'positions', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        //
       $data = $request->validated();
        if($request->hasFile('image')) {
            $this->deleteImage($employee->image);
            $data['image'] = $this->saveImage($request->file('image'));
        }
        $employee->update($data);
        return to_route('employees.index')->with('success','Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
        $this->deleteImage($employee->image);
        $employee->delete();
        return to_route('employees.index')->with('success','Employee deleted successfully');
    }

    /**
     * Will save the employee image
     */
    public function saveImage($image)
    {
        $image_name = time().'_'.$image->getClientOriginalName();
        $image->move(public_path('images'),$image_name);
        return $image_name;
    }


    /**
     * Will delete the employee image
     */
    public function deleteImage($image)
    {
        if(file_exists(public_path('images/'.$image))) {
            unlink(public_path('images/'.$image));
        }
    }


}
