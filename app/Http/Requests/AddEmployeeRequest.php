<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
    
        return [
            'id_staff' => 'required|string|unique:employees,id_staff|max:64',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'national_id' => 'nullable|string|max:255',
            'nssf_id' => 'nullable|string|max:255',
            'phone' => 'required|max:20',
            'place_of_birth' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'date_of_birth' => 'date',
            'hire_date' => 'date',
            'image' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
            'salary' => 'required|integer',
            'department_id' => 'exists:departments,id',
            'position_id' => 'exists:positions,id',
            'documents_submitted' => 'required|in:0,1',
            'status' => 'required|in:0,1'
        ];
    }
}
