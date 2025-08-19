<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    protected $fillable = [
        'employee_id',
        'month',
        'year',
        'working_days',
        'total_hours',
        'base_salary',
        'ot_1_5_pay',
        'ot_2_0_pay',
        'deduction',
        'total_salary',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
