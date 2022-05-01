<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlumniIdRequest;

class AlumniIdRequestController extends Controller
{
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
