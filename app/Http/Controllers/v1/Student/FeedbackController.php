<?php

namespace App\Http\Controllers\v1\Student;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\FeedbackMessage;
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
            'student_id' => auth('student')->user()->id,
            'admin_id' => 1
        ]);

        return response()->json(['message' => 'Feedback successfully added']);
    }

    public function getFeedbacks()
    {
        return response()->json(Feedback::where('student_id', auth('student')->user()->id)
            ->with(['admin', 'student.student_basic_info'])
            ->orderBy('created_at', 'desc')
            ->get()
        );
    }

    public function getFeedback($id)
    {
        return response()->json(Feedback::where('id', $id)
            ->with(['messages'])
            ->first()
        );
    }

    public function sendFeedback(Request $request) {

        return response()->json(Feedback::create([
            'student_id' => auth('student')->user()->student->id,
            'thread' => $request->content,
            'admin_id' => 1
        ]));
    }

    public function sendMessage($id, Request $request) {

        $this->validate($request, [
            'message' => 'required'
        ]);

        return response()->json(FeedbackMessage::create([
            'message' => $request->message,
            'feedback_id' => $id,
            'isAdmin' => false
        ]));
    }
}
