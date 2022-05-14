<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\FeedbackMessage;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index() {
        return response()->json(Feedback::all());
    }

    public function store() {
        return response()->json(Feedback::all());
    }

    public function destroy($id) {
        return response()->json(Feedback::destroy($id), 200);
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
