<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentAccountInfo;
use App\Models\StudentBasicInfo;
use App\Models\StudentEducationInfo;
use App\Models\StudentEmployeeInfo;

class AlumniAccountController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:admin');
    }
    
    public function index() {
        return response()->json(Student::whereHas('student_account_info', function($query) {
            $query->where('account_status', false);
        })->with('student_basic_info')->get());
    }

    public function approveAccount($id) {
        $student_account_info = StudentAccountInfo::where('id', $id)->where('account_status', false)->first();
        if(!empty($student_account_info)) {
            $student_account_info->account_status = true;
            $student_account_info->save();
        }else {
            return response()->json(['message' => 'Account not found'], 404);
        }
        return response()->json(['message' => 'Account approved']);
    }

    public function disapproveAccount($id) {

        $student_account_info = StudentAccountInfo::where('id', $id)->where('account_status', false)->first();
        if(!empty($student_account_info)) {
            StudentAccountInfo::destroy($id);
            StudentBasicInfo::destroy($id);
            StudentEmployeeInfo::destroy($id);
            StudentEducationInfo::destroy($id);
            Student::destroy($id);
        }else {
            return response()->json(['message' => 'Account not found'], 404);
        }
        return response()->json(['message' => 'Account disapproved']);
    }

}
