<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_staff',
        'nssf_id',
        'first_name',
        'last_name',
        'phone',
        'national_id',
        'place_of_birth',
        'address',
        'image',
        'status',
        'documents_submitted',
        'salary',
        'department_id',
        'position_id',
        'date_of_birth',
        'hire_date',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    
    public function holidays()
    {
        return $this->hasMany(Holiday::class);
    }

    public function scopeWithRelationshipAutoloading($query)
    {
        return $query->with(['holidays','attendance','department','position']);
    }
}
