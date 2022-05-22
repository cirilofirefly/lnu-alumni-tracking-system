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
        $batch = isset($request->batch) ? $request->batch : '';
        $college = isset($request->college) ? $request->college : '';
        $program = isset($request->program) ? $request->program : '';

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
                StudentAccountInfo::where(function($query) use($batch, $college, $program) {
                        $query->where('employment_status', "Employed");
                        if($batch) {
                            $query->where('batch_id', $batch);
                        }
                        if($college) {
                            $query->where('college', $college);
                        }
                        if($program) {
                            $query->where('program', $program);
                        }
                })->count(),
                StudentAccountInfo::where(function($query) use($batch, $college, $program) {
                        $query->where('employment_status', "Not Employed");
                        if($batch) {
                            $query->where('batch_id', $batch);
                        }
                        if($college) {
                            $query->where('college', $college);
                        }
                        if($program) {
                            $query->where('program', $program);
                        }
                })->count(),
                StudentAccountInfo::where('employment_status', "Looking for a Job")
                    ->where(function($query) use($batch) {
                        if($batch) {
                            $query->where('batch_id', $batch);
                        }
                    })
                    ->where(function($query) use($college) {
                        if($college) {
                            $query->where('college', $college);
                        }
                    })
                    ->where(function($query) use($program) {
                        if($program) {
                            $query->where('program', $program);
                        }
                    })
                ->count(),
                StudentAccountInfo::where('employment_status', "Further Study")
                    ->orWhere(function($query) use($batch) {
                        if($batch) {
                            $query->where('batch_id', $batch);
                        }
                    })
                    ->orWhere(function($query) use($college) {
                        if($college) {
                            $query->where('college', $college);
                        }
                    })
                    ->orWhere(function($query) use($program) {
                        if($program) {
                            $query->where('program', $program);
                        }
                    })
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
