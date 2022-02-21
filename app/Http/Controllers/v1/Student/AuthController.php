<?php

namespace App\Http\Controllers\v1\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentAccountInfo;
use App\Models\StudentBasicInfo;
use App\Models\StudentEducationInfo;
use App\Models\StudentEmployeeInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth:student', ['except' => ['login', 'signup']]);
    }

    public function login(Request $request) {

        if (! $token = auth()->guard('student')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return auth('student')->user()->account_status ?  $this->respondWithToken($token) : response()->json(['message' => 'Your account did not approved by Admin. Please wait for the approval.']);
    }

    // 
    public function logout()
    {
        auth('student')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }


    public function signup(Request $request) {

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|confirmed|min:8|max:50',
            'student_number' => 'required',
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'current_address' => 'required',
            'permanent_address' => 'required',
            'mobile_number' => 'required',
            'telephone_number' => 'required',
            'birthdate' => 'required',
            'birthplace' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'civil_status' => 'required',
            'educational_attainment' => 'required',
            'year_graduate' => 'required',
            'college' => 'required',
            'program' => 'required',
            'degree_level' => 'required',
            'image' => 'required|image|mimes:png|max:10000',
            'pdf' => 'required|mimes:pdf|max:10000',
        ]);

        DB::beginTransaction();

        try {

            $student_account_info = StudentAccountInfo::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'account_status' => true,
                'educational_attainment' => $request->educational_attainment,
                'year_graduate' => $request->year_graduate,
                'college' => $request->college,
                'program' => $request->program,
                'degree_level' => $request->degree_level
            ]);
    
            $student_basic_info = StudentBasicInfo::create([
                'student_number' => $request->student_number,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'current_address' => $request->current_address,
                'permanent_address' => $request->permanent_address,
                'mobile_number' => $request->mobile_number,
                'telephone_number' => $request->telephone_number,
                'email' => $request->email,
                'birthdate' => $request->birthdate,
                'birthplace' => $request->birthplace,
                'religion' => $request->religion,
                'gender' => $request->gender,
                'civil_status' => $request->civil_status,
            ]);
    
            $student_education_info = StudentEducationInfo::create();
            $student_employee_info = StudentEmployeeInfo::create();

            $tor = $request->file('pdf');
            $id_image = $request->file('image');

            $tor_name = $tor->getClientOriginalExtension();
            $tor_name = $request->student_number . '.' . $tor_name;
            $tor->move(public_path('/alumni/files/images/tors'), $tor_name);
            $tor_path = '/alumni/files/tors/' . $tor_name;

            $id_image_name = $id_image->getClientOriginalExtension();
            $id_image_name = $request->student_number . '.' . $id_image_name;
            $id_image->move(public_path('/alumni/files/images/ids'), $id_image_name);
            $id_image_path = '/alumni/files/images/ids/' . $id_image;

            Student::create([
                'student_account_info_id' => $student_account_info->id,
                'student_basic_info_id' => $student_basic_info->id,
                'student_education_info_id' => $student_education_info->id,
                'student_employee_info_id' => $student_employee_info->id,
                'id_image' => $id_image_path,
                'tor_file' => $tor_path,
                'accept_term' => $request->accept_term ? 1 : 0
            ]);

            DB::commit();
            return response()->json(['message' => "You successfully registered. Wait for admin's approval"]);
        
        }
        catch(\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th], 500);
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('admin')->factory()->getTTL() * 60,
        ]);
    }
}
