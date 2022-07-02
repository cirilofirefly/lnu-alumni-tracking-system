<?php

namespace App\Http\Controllers\v1;

use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Controller;
use Spatie\DbDumper\Databases\MySql;

class DownloadController extends Controller
{
    public function store()
    {
        // $res = Artisan::call('backup:run', ['--only-db' => true]);

        // return response()->json($res);

        MySql::create()
            ->setDbName('lnu_alumni_info_tracking')
            ->setUserName('root')
            ->setPassword('')
            ->dumpToFile('dump.sql');
    }
}
