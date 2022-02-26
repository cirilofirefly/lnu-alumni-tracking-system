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
        return $this->hasOne(StudentAccountInfo::class, 'id', 'student_account_info_id');
    }

    public function student_basic_info() {
        return $this->hasOne(StudentBasicInfo::class, 'id', 'student_basic_info_id');
    }

}
