<?php

namespace Database\Seeders;

use App\Models\Batch;
use Illuminate\Database\Seeder;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $batches = [
            ['batch' => 2010],
            ['batch' => 2011],
            ['batch' => 2012],
            ['batch' => 2013],
            ['batch' => 2014],
            ['batch' => 2015]
        ];
        foreach($batches as $batch) {
            Batch::create($batch);
        }
    }
}
