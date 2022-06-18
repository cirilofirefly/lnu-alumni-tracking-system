<?php

namespace App\Http\Controllers\v1\Student;

use App\Http\Controllers\Controller;
use App\Models\Employee\Company;
use App\Models\Student;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index() {
        $student_id = Student::where('student_account_info_id', auth('student')->user()->id)->first()->id;
        return response()->json(Company::where('student_id', $student_id)->get());
    }

    public function store(Request $request) {
        $student_id = Student::where('student_account_info_id', auth('student')->user()->id)->first()->id;
        Company::destroy($request['company_ids']);
        foreach($request['companies'] as $company) {
            $employee_company = Company::where('id', $company['id'])->first();

            $data = [
                'student_id'    => $student_id,
                'company'       => $company['company'],
                'designation'   => $company['designation'],
                'address'       => $company['address'],
            ];

            $employee_company ? $employee_company->update($data) : Company::create($data);
        }
        return response()->json(['message' => 'Company Saved.'], 200);
    }

    public function destroy(Request $request) {
        return Company::destroy($request['company_ids']);
    }
}
