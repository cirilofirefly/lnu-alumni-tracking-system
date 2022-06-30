<?php

namespace App\Http\Controllers\v1;

use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Controller;

class DownloadController extends Controller
{


    public function download()
    {

        Artisan::call('backup:run --only-db');
        // $path = storage_path('storage/app/Laravel/*');
        // $latest_ctime = 0;
        // $latest_filename = '';
        // $files = glob($path);
        // foreach ($files as $file) {
        //     if (is_file($file) && filectime($file) > $latest_ctime) {
        //         $latest_ctime = filectime($file);
        //         $latest_filename = $file;
        //     }
        // }
        // return response()->download($latest_filename);
    }
}
