<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function totalAlumni() {
        return response()->json(Batch::withCount('student_account_infos')->get());
    }
}
