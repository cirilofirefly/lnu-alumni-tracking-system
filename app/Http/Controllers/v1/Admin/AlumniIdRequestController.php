<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlumniIdRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\v1\MailController;
use App\Models\Student;
use App\Models\StudentBasicInfo;

class AlumniIdRequestController extends Controller
{
    public function searchStudentIDRequests($type)
    {
        return response()->json(AlumniIdRequest::with(['alumniInfo', 'student.student_basic_info'])->where('status', $type)->get());
    }

    public function getStudentIDRequests($type)
    {
        return response()->json(AlumniIdRequest::with(['alumniInfo', 'student.student_basic_info'])->where('status', $type)->get());
    }

    public function getStudentIDRequest($id)
    {
        return response()->json(AlumniIdRequest::with(['alumniInfo', 'student.student_basic_info'])->where('id', $id)->first());
    }

    public function approveStudentIDRequest($id)
    {
        $alumni_id_request = AlumniIdRequest::where('id', $id)->first();
        $alumni_id_request->status = true;

        $student = Student::where('id', $alumni_id_request->student_id)->first();
        $student_basic_info = StudentBasicInfo::where('id', $student->student_basic_info_id)->first();
        MailController::sendApproveID($student_basic_info->first_name, $student_basic_info->email);
        $alumni_id_request->save();
        return response()->json(['message' => 'ID Request Approved']);
    }

    public function disapproveStudentIDRequest($id)
    {
        $alumni_id_request = AlumniIdRequest::where('id', $id)->first();
        $alumni_id_request->status = false;
        $alumni_id_request->save();
        return response()->json(['message' => 'ID Request Dispproved']);
    }
}
