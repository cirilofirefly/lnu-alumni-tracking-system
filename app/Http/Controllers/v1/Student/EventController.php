<?php

namespace App\Http\Controllers\v1\Student;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventController extends Controller
{
    //
    public function show($slug) {
        return response(Event::with('category')->where('slug', $slug)->first());
    }

    public function latestEvent() {
        return response()->json(Event::with('category')->latest()->first());
    }
}
