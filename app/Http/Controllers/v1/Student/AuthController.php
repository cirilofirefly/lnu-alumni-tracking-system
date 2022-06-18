<?php

namespace App\Http\Controllers\v1\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentAccountInfo;
use App\Models\StudentBasicInfo;
use App\Models\StudentEducationInfo;
use App\Models\StudentEmployeeInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
        ]);

        DB::beginTransaction();

        try {

            $student_account_info = StudentAccountInfo::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'account_status' => false,
                'educational_attainment' => 'NO DATA',
                'batch_id' => null,
                'college' => 'NO DATA',
                'program' => 'NO DATA',
                'degree_level' => 'NO DATA'
            ]);
    
            $student_basic_info = StudentBasicInfo::create([
                'student_number' => $request->student_number,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'current_address' => 'NO DATA',
                'permanent_address' => 'NO DATA',
                'mobile_number' => 'NO DATA',
                'telephone_number' => 'NO DATA',
                'email' => $request->email,
                'birthplace' => 'NO DATA',
                'religion' => 'NO DATA',
                'gender' => 'NO DATA',
                'civil_status' => 'NO DATA',
            ]);
    
            $student_education_info = StudentEducationInfo::create();
            $student_employee_info = StudentEmployeeInfo::create();

            Student::create([
                'student_account_info_id' => $student_account_info->id,
                'student_basic_info_id' => $student_basic_info->id,
                'student_education_info_id' => $student_education_info->id,
                'student_employee_info_id' => $student_employee_info->id,
                'id_image' => 'NO DATA',
                'tor_file' => 'NO DATA',
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

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(StudentAccountInfo::with(['student.student_account_info', 'student.student_basic_info', 'student.student_education_info', 'batch'])->where('id', auth('student')->user()->id)->get());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('admin')->factory()->getTTL() * 60,
        ]);
    }

    public function changePassword(Request $request) {

        $this->validate($request, [
            'oldPassword' => 'required',
            'password' => 'required|max:8|confirmed'
        ]);

        $student_account_info = StudentAccountInfo::where('id', auth('student')->user()->id)->first();
        if($student_account_info) {
            if(Hash::check($request->oldPassword, $student_account_info->password)) {
                $student_account_info->password = bcrypt($request->password);
                $student_account_info->save();
            }
        }

        return response()->json([], 200);
    }
}
