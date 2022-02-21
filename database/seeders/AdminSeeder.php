<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\AdminInfo;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_info = AdminInfo::create([
            'first_name' => 'Rile Austin',
            'last_name' => 'Pedero',
            'email' => 'rap@email.com',
            'contact_number' => '09123456789'
        ]);
        
        Admin::create([
            'username' => 'rileaustin',
            'password' => bcrypt('rileaustin'),
            'admin_info_id' => $admin_info->id
        ]);
    }
}
