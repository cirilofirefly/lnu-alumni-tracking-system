<?php

namespace App\Http\Controllers\v1\Student;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    //

    public function index() {
        return response()->json(Feedback::all());
    }
}
