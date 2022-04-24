<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Student;

class DashboardController extends Controller
{
    public function totalAlumni() {
        return response()->json(Batch::withCount('student_account_infos')->get());
    }

    public function totalBatch() {
        return response()->json(Batch::count());
    }

    public function totalAlumniRecords() {
        return response()->json(Student::count());
    }
}
