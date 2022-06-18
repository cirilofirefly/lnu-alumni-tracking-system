<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['login']]);
    }

    public function login(Request $request)
    {

        if (! $token = auth()->guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        return $this->respondWithToken($token);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('admin')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(Admin::with('admin_info')->where('id', auth('admin')->user()->id)->first());
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

        $admin = Admin::where('id', auth('admin')->user()->id)->first();
        if($admin) {
            if(Hash::check($request->oldPassword, $admin->password)) {
                $admin->password = bcrypt($request->password);
                $admin->save();
            }
        }

        return response()->json([], 200);
    }

    public function updateAccount(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'contact_number' => 'required'
        ]);
        $admin = Admin::with('admin_info')->where('id', auth('admin')->user()->id)->first();
        $admin->admin_info->first_name = $request->first_name;
        $admin->admin_info->middle_name = $request->middle_name;
        $admin->admin_info->last_name = $request->last_name;
        $admin->admin_info->email = $request->email;
        $admin->admin_info->contact_number = $request->contact_number;
        $admin->admin_info->save();
        return response()->json([]);
    }
}
