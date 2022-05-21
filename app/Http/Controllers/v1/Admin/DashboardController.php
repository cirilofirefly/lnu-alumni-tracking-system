<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlumniIdRequest;
use App\Models\Batch;
use App\Models\Student;
use App\Models\StudentAccountInfo;

class DashboardController extends Controller
{
    public function totalAlumni() 
    {
        return response()->json([
            'batch' => Batch::withCount('student_account_infos')->get(),
            'alumni_id' => Batch::with(['student_account_infos.student' => function($query) {
                $query->withCount(['alumniRequest' => function($query) {
                    $query->where('status', '!=', 0);
                }]);
            }])->get(),
            'employee' => Batch::with(['student_account_infos.student' => function($query) {
                $query->withCount(['student_employee_info' => function($query) {
                    $query->where('company', '!=', null);
                }]);
            }])->get(),
            'graph' => [
                StudentAccountInfo::where('employment_status', "Employment")->count(),
                StudentAccountInfo::where('employment_status', "Current looking for Employment")->count(),
                StudentAccountInfo::where('employment_status', "Futher Study")->count(),
            ]
        ]);
    }

    public function totalAlumniID() 
    {
        return response()->json(AlumniIdRequest::count());
    }

    public function totalBatch() 
    {
        return response()->json(Batch::count());
    }

    public function totalAlumniRecords() 
    {
        return response()->json([
                'alumni_records' => StudentAccountInfo::where('account_status', 1)->count(),
                'alumni_id_records_count' => AlumniIdRequest::where('status', 1)->count()
            ]);
    }

    public function totalAlumniApplication()
    {
        return response()->json(Student::count());
    }
}
