<?php

namespace App\Http\Controllers\v1;

use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Controller;
use Spatie\DbDumper\Databases\MySql;

class DownloadController extends Controller
{
    public function store()
    {
        Artisan::call('backup:run --only-db');
    }
}
