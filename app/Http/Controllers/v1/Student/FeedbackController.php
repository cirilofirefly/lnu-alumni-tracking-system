<?php

namespace App\Http\Controllers\v1\Student;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    //

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function index() {
        return response()->json(Feedback::all());
    }

    public function store(Request $request) {
        $this->validate($request, [
            'thread' => 'required'
        ]);

        Feedback::create([
            'thread' => $request->thread,
            'student_id' => auth('student')->user()->id
        ]);

        return response()->json(['message' => 'Feedback successfully added']);
    }
}
