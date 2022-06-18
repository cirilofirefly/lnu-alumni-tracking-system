<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elegibility extends Model
{
    use HasFactory;

    protected $table = 'employee_elegibilities';
    protected $fillable = [
        'student_id',
        'elegibilitiy',
        'category'
    ];

    public function student() {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
