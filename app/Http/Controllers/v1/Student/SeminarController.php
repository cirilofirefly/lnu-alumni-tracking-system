<?php

namespace App\Http\Controllers\v1\Student;

use App\Http\Controllers\Controller;
use App\Models\Employee\Seminar;
use App\Models\Student;
use Illuminate\Http\Request;

class SeminarController extends Controller
{
    public function index() {
        $student_id = Student::where('student_account_info_id', auth('student')->user()->id)->first()->id;
        return response()->json(Seminar::where('student_id', $student_id)->get());
    }

    public function store(Request $request) {
        $student_id = Student::where('student_account_info_id', auth('student')->user()->id)->first()->id;
        Seminar::destroy($request['seminar_ids']);
        foreach($request['seminars'] as $seminar) {
            $employee_seminar = Seminar::where('id', $seminar['id'])->first();

            $data = [
                'student_id'        => $student_id,
                'seminar'      => $seminar['seminar'],
            ];

            $employee_seminar ? $employee_seminar->update($data) : Seminar::create($data);
        }
        return response()->json(['message' => 'Seminar Saved.'], 200);
    }

    public function destroy(Request $request) {
        return Seminar::destroy($request['company_ids']);
    }
}
