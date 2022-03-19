<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    //
    public function index() {
        return response()->json(Student::with(['student_basic_info'])->get());
    }

    public function show($id) {
        return response()->json(Student::where('id', $id)->with(['student_account_info.batch', 'student_basic_info', 'student_education_info', 'student_employee_info'])->first());
    }
}
