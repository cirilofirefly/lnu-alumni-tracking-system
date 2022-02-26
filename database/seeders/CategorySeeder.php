<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category::create(['category' => 'Announcement']);
        Category::create(['category' => 'Enrollment']);
        Category::create(['category' => 'Job Hiring']);

    }
}
