<?php

namespace App\Http\Controllers\v1\Student;

use App\Http\Controllers\Controller;
use App\Models\Employee\Elegibility;
use App\Models\Student;
use Illuminate\Http\Request;

class ElegibilityController extends Controller
{
    public function index() {
        $student_id = Student::where('student_account_info_id', auth('student')->user()->id)->first()->id;
        return response()->json(Elegibility::where('student_id', $student_id)->get());
    }

    public function store(Request $request) {
        $student_id = Student::where('student_account_info_id', auth('student')->user()->id)->first()->id;
        Elegibility::destroy($request['elegibility_ids']);
        foreach($request['elegibilities'] as $eligibility) {
            $employee_elegibility = Elegibility::where('id', $eligibility['id'])->first();

            $data = [
                'student_id'        => $student_id,
                'elegibilitiy'      => $eligibility['elegibilitiy'],
                'category'          => $eligibility['category'],
            ];

            $employee_elegibility ? $employee_elegibility->update($data) : Elegibility::create($data);
        }
        return response()->json(['message' => 'Elegibility Saved.'], 200);
    }

    public function destroy(Request $request) {
        return Elegibility::destroy($request['company_ids']);
    }
}
