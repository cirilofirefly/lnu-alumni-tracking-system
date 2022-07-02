<?php

namespace App\Http\Controllers\v1\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentBasicInfo;
use App\Models\Student;
use App\Models\StudentAccountInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\v1\MailController;

class ForgotPasswordController extends Controller
{

    public function sendForgotPassword(Request $request)
    {
        $student_basic_info = StudentBasicInfo::where('email', $request->email)->first();
        MailController::sendForgotPassword($student_basic_info->first_name, $student_basic_info->email);
        return response()->json($student_basic_info);
    }

    public function resetPassword(Request $request)
    {
        $student = Student::where('student_basic_info_id', $request->id)->first();
        $student_account_info = StudentAccountInfo::where('id', $student->student_account_info_id)->first();
        $student_account_info->password = bcrypt($request->password);
        $student_account_info->save();
        return response()->json([], 200);
    }
}
