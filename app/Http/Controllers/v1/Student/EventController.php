<?php

namespace App\Http\Controllers\v1\Student;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //
    public function index() {
        return response(Event::with('category')->inRandomOrder()->limit(1)->get());
    }
}
