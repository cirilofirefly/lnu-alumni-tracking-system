<?php

namespace App\Http\Controllers\v1\Student;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventComment;
use App\Models\StudentAccountInfo;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index() {
        return response(Event::with('category')->latest()->get());
    }
    public function show($slug) {
        return response(Event::with(['category', 'comments.student:id,id_image'])->where('slug', $slug)->first());
    }
    public function latestEvent() {
        return response()->json(Event::with('category')->latest()->first());
    }

    public function getComments(Request $request) {
        return response()->json(Event::where('id', $request->event_id)->first()->comments(), 200);
    }

    public function postComment(Request $request) {
        $this->validate($request,[
            'comment' => 'required'
        ]);

        $student_account = StudentAccountInfo::where('id', auth('student')->user()->id)->first();

        $event = Event::where('id', $request->event_id)->first();
        $event->comments()->create([
            'comment' => $request->comment,
            'student_id' => $student_account->student()->get()->first()->id
        ]);

        return response()->json(['message' => 'Comment added.'], 200);

    }
}
