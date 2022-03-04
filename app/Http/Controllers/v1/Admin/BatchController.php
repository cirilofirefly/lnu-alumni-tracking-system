<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BatchController extends Controller
{
    //

    public function index() {
        return response()->json(Batch::all());
    }

    public function store() {

        DB::beginTransaction();
        try {

            $latest_batch = Batch::latest()->first();
            Batch::create(['batch' => $latest_batch->batch + 1]);
            DB::commit();
            return response()->json(['messasge' => 'New Batch added']);
        }catch(\Throwable $th) {
            DB::rollBack();
            return response()->json($th, 500);
        }
    }

    public function destroy($id) {

        $batch = Batch::with('student_account_infos')->where('id', $id)->first();
        if(count($batch->student_account_infos) > 0) {
            return response()->json(['error' => 'Current batch has a record. Empty the current batch'], 400); 
        }else {
            Batch::destroy($id);
            return response()->json(['messasge' => 'Batch deleted']); 
        }
    }
}
