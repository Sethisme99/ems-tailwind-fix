<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //
    protected $fillable = [
        'employee_id',
        'date',
        'check_in',
        'check_out',
        'total_hours_worked'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function scopeWithRelationshipAutoloading($query)
    {
        return $query->with('employee');
    }
}
