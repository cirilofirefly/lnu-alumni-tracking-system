<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Batch;

class BatchController extends Controller
{
    //

    public function index() {
        return response()->json(Batch::all());
    }
}
