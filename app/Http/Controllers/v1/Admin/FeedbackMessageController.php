<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeedbackMessage;
use Illuminate\Http\Request;

class FeedbackMessageController extends Controller
{
    //

    public function index() {
        return response()->json(FeedbackMessage::all());
    }
    public function store(Request $request) {
        return response()->json(FeedbackMessage::create($request->all()), 200);
    }
}
