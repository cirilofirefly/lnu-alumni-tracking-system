<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentAccountInfo;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    //
    public function index() {
        return response()->json(StudentAccountInfo::with(['student.student_basic_info'])->where('account_status', 1)->get());
    }

    public function show($id) {
        return response()->json(Student::where('id', $id)->with(['student_account_info.batch', 'student_basic_info', 'student_education_info', 'student_employee_info'])->first());
    }
}
