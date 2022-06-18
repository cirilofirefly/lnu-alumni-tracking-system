<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function student_account_info() {
        return $this->belongsTo(StudentAccountInfo::class, 'student_account_info_id', 'id');
    }

    public function student_basic_info() {
        return $this->belongsTo(StudentBasicInfo::class, 'student_basic_info_id', 'id');
    }

    public function student_education_info() {
        return $this->belongsTo(StudentEducationInfo::class, 'student_education_info_id', 'id');
    }

    public function student_employee_info() {
        return $this->belongsTo(StudentEmployeeInfo::class, 'student_employee_info_id', 'id');
    }

    public function alumniRequest()
    {
        return $this->hasMany(AlumniIdRequest::class, 'student_id', 'id');
    }

    public function companies()
    {
        return $this->hasMany('App\Employee\Company', 'student_id');
    }

    public function seminars()
    {
        return $this->hasMany('App\Employee\Seminar', 'student_id');
    }

    public function elegibilities()
    {
        return $this->hasMany('App\Employee\Elegibilitiy', 'student_id');
    }

}
