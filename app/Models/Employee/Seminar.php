<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    use HasFactory;

    protected $table = 'employee_seminars';
    protected $fillable = [
        'student_id',
        'seminar'
    ];

    public function student() {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
