<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentAccountInfo;
use App\Models\StudentBasicInfo;
use App\Models\StudentEducationInfo;
use App\Models\StudentEmployeeInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\v1\MailController;


class AlumniAccountController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {

        $search = $request->search;
        $students = DB::table('students')
            ->join('student_account_infos', 'student_account_infos.id', '=', 'students.student_account_info_id')
            ->join('student_basic_infos', 'student_basic_infos.id', '=', 'students.student_basic_info_id');

        $student_info = $students->where(function ($query) use ($search) {
            if ($search) {
                $query->where('first_name', 'like', "%$search%");
            }
            $query->where('account_status', false);
        })->get();

        return response()->json($student_info);
    }

    public function approveAccount($id)
    {
        $student_account_info = StudentAccountInfo::where('id', $id)->where('account_status', false)->first();
        if (!empty($student_account_info)) {
            $student_account_info->account_status = true;
            $student_account_info->save();
        } else {
            return response()->json(['message' => 'Account not found'], 404);
        }
        $student = Student::where('student_account_info_id', $id)->first();
        $student_basic_info = StudentBasicInfo::where('id', $student->student_basic_info_id)->first();
        MailController::sendSignupEmail($student_basic_info->first_name, $student_basic_info->email);
        return response()->json(['message' => 'Account approved']);
    }

    public function disapproveAccount($id)
    {

        $student_account_info = StudentAccountInfo::where('id', $id)->where('account_status', false)->first();
        if (!empty($student_account_info)) {
            StudentAccountInfo::destroy($id);
            StudentBasicInfo::destroy($id);
            StudentEmployeeInfo::destroy($id);
            StudentEducationInfo::destroy($id);
            Student::destroy($id);
        } else {
            return response()->json(['message' => 'Account not found'], 404);
        }
        return response()->json(['message' => 'Account disapproved']);
    }
}
