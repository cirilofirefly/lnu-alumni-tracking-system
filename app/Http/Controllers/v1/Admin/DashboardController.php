<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlumniIdRequest;
use App\Models\Batch;
use App\Models\Student;
use App\Models\StudentAccountInfo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function totalAlumni(Request $request) 
    {
       
        $studentAccountCount = StudentAccountInfo::where('employment_status', "Further Study")
            ->when($request->batch, fn ($query) => $query->where('batch_id', $request->batch))
            ->when($request->college, fn ($query) => $query->where('college', $request->college))
            ->when($request->program, fn ($query) => $query->where('program',  $request->program))
            ->count();

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
                StudentAccountInfo::where('employment_status', "Employed")
                    ->when($request->batch, fn ($query) => $query->where('batch_id', $request->batch))
                    ->when($request->college, fn ($query) => $query->where('college', $request->college))
                    ->when($request->program, fn ($query) => $query->where('program',  $request->program))
                    ->count(),
                StudentAccountInfo::where('employment_status', "Not Employed")
                    ->when($request->batch, fn ($query) => $query->where('batch_id', $request->batch))
                    ->when($request->college, fn ($query) => $query->where('college', $request->college))
                    ->when($request->program, fn ($query) => $query->where('program',  $request->program))
                    ->count(),
                StudentAccountInfo::where('employment_status', "Looking for a Job")
                    ->when($request->batch, fn ($query) => $query->where('batch_id', $request->batch))
                    ->when($request->college, fn ($query) => $query->where('college', $request->college))
                    ->when($request->program, fn ($query) => $query->where('program',  $request->program))
                    ->count(),
                StudentAccountInfo::where('employment_status', "Further Study")
                    ->when($request->batch, fn ($query) => $query->where('batch_id', $request->batch))
                    ->when($request->college, fn ($query) => $query->where('college', $request->college))
                    ->when($request->program, fn ($query) => $query->where('program',  $request->program))
                    ->count(),
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
