<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'employee_companies';
    protected $fillable = [
        'student_id',
        'company',
        'designation',
        'address'
    ];

    public function student() {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
