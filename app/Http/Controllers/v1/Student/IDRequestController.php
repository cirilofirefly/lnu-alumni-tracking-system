<?php

namespace App\Http\Controllers\v1\Student;

use App\Http\Controllers\Controller;
use App\Models\AlumniIdRequest;
use App\Models\AlumniIdRequestInfo;
use App\Models\Student;
use App\Models\StudentAccountInfo;
use Illuminate\Http\Request;

class IDRequestController extends Controller
{
    public function show($id) 
    {
        return response()->json(Student::where('id', $id)->with(['student_account_info.batch', 'student_basic_info', 'student_education_info', 'student_employee_info'])->first());
    }

    public function updateAccount(Request $request) 
    {
        $student = Student::where('id', $request->id)->with(['student_account_info','student_basic_info', 'student_education_info', 'student_employee_info'])->first();
        $student->student_account_info->username = $request['student_account_info']['username'];
        $student->student_account_info->educational_attainment = $request['student_account_info']['educational_attainment'];
        $student->student_account_info->batch_id = $request['student_account_info']['batch_id'];
        $student->student_account_info->college = $request['student_account_info']['college'];
        $student->student_account_info->program = $request['student_account_info']['program'];
        $student->student_account_info->degree_level = $request['student_account_info']['degree_level'];
        $student->student_account_info->employment_status = $request['student_account_info']['employment_status'];
        $student->student_account_info->save();
        $student->student_basic_info->first_name = $request['student_basic_info']['first_name'];
        $student->student_basic_info->middle_name = $request['student_basic_info']['middle_name'];
        $student->student_basic_info->last_name = $request['student_basic_info']['last_name'];
        $student->student_basic_info->suffix = $request['student_basic_info']['suffix'];
        $student->student_basic_info->email = $request['student_basic_info']['email'];
        $student->student_basic_info->current_address = $request['student_basic_info']['current_address'];
        $student->student_basic_info->permanent_address = $request['student_basic_info']['permanent_address'];
        $student->student_basic_info->mobile_number = $request['student_basic_info']['mobile_number'];
        $student->student_basic_info->telephone_number = $request['student_basic_info']['telephone_number'];
        $student->student_basic_info->birthdate = $request['student_basic_info']['birthdate'];
        $student->student_basic_info->birthplace = $request['student_basic_info']['birthplace'];
        $student->student_basic_info->religion = $request['student_basic_info']['religion'];
        $student->student_basic_info->gender = $request['student_basic_info']['gender'];
        $student->student_basic_info->civil_status = $request['student_basic_info']['civil_status'];
        $student->student_basic_info->save();
        $student->student_education_info->elem = $request['student_education_info']['elem'];
        $student->student_education_info->elem_year = $request['student_education_info']['elem_year'];
        $student->student_education_info->jhs = $request['student_education_info']['jhs'];
        $student->student_education_info->jhs_year = $request['student_education_info']['jhs_year'];
        $student->student_education_info->shs = $request['student_education_info']['shs'];
        $student->student_education_info->shs_year = $request['student_education_info']['shs_year'];
        $student->student_education_info->shs_strand = $request['student_education_info']['shs_strand'];
        $student->student_education_info->gs = $request['student_education_info']['gs'];
        $student->student_education_info->gs_year = $request['student_education_info']['gs_year'];
        $student->student_education_info->gs_course = $request['student_education_info']['gs_course'];
        $student->student_education_info->pgs = $request['student_education_info']['pgs'];
        $student->student_education_info->pgs_year = $request['student_education_info']['pgs_year'];
        $student->student_education_info->pgs_course = $request['student_education_info']['pgs_course'];
        $student->student_education_info->save();
        $student->student_employee_info->company = $request['student_employee_info']['company'];
        $student->student_employee_info->designation = $request['student_employee_info']['designation'];
        $student->student_employee_info->address = $request['student_employee_info']['address'];
        $student->student_employee_info->tel_no = $request['student_employee_info']['tel_no'];
        $student->student_employee_info->mobile_no = $request['student_employee_info']['mobile_no'];
        $student->student_employee_info->email = $request['student_employee_info']['email'];
        $student->student_employee_info->sp_name = $request['student_employee_info']['sp_name'];
        $student->student_employee_info->sp_occupation = $request['student_employee_info']['sp_occupation'];
        $student->student_employee_info->sp_mobile_no = $request['student_employee_info']['sp_mobile_no'];
        $student->student_employee_info->sp_company = $request['student_employee_info']['sp_company'];
        $student->student_employee_info->sp_position = $request['student_employee_info']['sp_position'];
        $student->student_employee_info->sp_buss_address = $request['student_employee_info']['sp_buss_address'];
        $student->student_employee_info->sp_fax_no = $request['student_employee_info']['sp_fax_no'];
        $student->student_employee_info->sp_email = $request['student_employee_info']['sp_email'];
        $student->student_employee_info->save();
        return response()->json(['message' => 'Account Updated'], 200);
    }

    public function uploadImage(Request $request) 
    {
        
        $this->validate($request, [
            'image' => 'required|image|mimes:png,jpg|max:10000',
        ]);

        $id_image = $request->file('image');
        $id_image_name = $id_image->getClientOriginalExtension();
        $id_image_name = $request->student_number . '.' . $id_image_name;
        $id_image->move(public_path('/alumni/files/images/ids'), $id_image_name);
        $id_image_path = '/alumni/files/images/ids/' . $id_image_name;

        $student_account = StudentAccountInfo::where('id', auth('student')->user()->id)->first(); 
        $student_account->student->id_image = $id_image_path;
        $student_account->student->save();

        return response()->json(['message' => 'Image uploaded.'], 200);
    }

    public function uploadSignature(Request $request) 
    {
        
        $this->validate($request, [
            'signature' => 'required|image|mimes:png,jpg|max:10000',
        ]);

        $signature = $request->file('signature');
        $signature_name = $signature->getClientOriginalExtension();
        $signature_name = $request->student_number . '.' . $signature_name;
        $signature->move(public_path('/alumni/files/images/signature'), $signature_name);
        $signature_path = '/alumni/files/images/signature/' . $signature_name;

        $student_account = StudentAccountInfo::where('id', auth('student')->user()->id)->first(); 
        $student_account->student->signature = $signature_path;
        $student_account->student->save();

        return response()->json(['message' => 'Signature uploaded.'], 200);
    }

    public function sendIdRequest(Request $request)
    {
        $student_account = StudentAccountInfo::where('id', auth('student')->user()->id)->first();
        $alumni_request_info = AlumniIdRequestInfo::create([
            'student_number' => $request->student_number,
            'course'         => $request->course,
            'batch'          => $request->batch,
            'full_name'      => $request->full_name,
            'address'        => $request->address,
            'date_of_birth'  => $request->date_of_birth,
            'email'  => $request->email_address,
            'mobile_no'      => $request->mobile_no,
            'telephone_no'   => $request->telephone_no,
            'image'          => $request->image,
            'signature'      => $request->signature,

        ]);
        AlumniIdRequest::create([
            'alumni_id_request_info_id' => $alumni_request_info->id,
            'student_id' => $student_account->student->id
        ]);
        return response()->json(['message' => 'ID Request sent.']);
    }

    public function requestLogs()
    {
        return response()->json(AlumniIdRequest::all());
    }
}
