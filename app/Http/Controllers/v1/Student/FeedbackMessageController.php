<?php

namespace App\Http\Controllers\v1\Student;

use App\Http\Controllers\Controller;
use App\Models\FeedbackMessage;
use Illuminate\Http\Request;

class FeedbackMessageController extends Controller
{
    //

    public function index(Request $request) {
        return response()->json(FeedbackMessage::all());
    }


    public function store(Request $request) {
        $this->validate($request, [
            'message' => 'required',
            'feedback_id' => 'required'
        ]);

        FeedbackMessage::create([
            'thread' => $request->message,
            'student_id' => auth('student')->user()->id,
            'feedback_id' => $request->feedback_id
        ]);

    }


}
