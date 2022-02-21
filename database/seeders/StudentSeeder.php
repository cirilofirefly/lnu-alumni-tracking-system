<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\StudentAccountInfo;
use App\Models\StudentBasicInfo;
use App\Models\StudentEducationInfo;
use App\Models\StudentEmployeeInfo;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $student_account_info = StudentAccountInfo::create([
            'username' => 'rileaustin',
            'password' => bcrypt('rileaustin'),
            'account_status' => false,
            'educational_attainment' => '',
            'year_graduate' => '',
            'college' => '',
            'program' => '',
            'degree_level' => ''
        ]);

        $student_basic_info = StudentBasicInfo::create([
            'student_number' => '1800700',
            'first_name' => 'Rile Austin',
            'last_name' => 'Picardal',
            'current_address' => 'Brgy Mabuhay',
            'permanent_address' => 'Brgy Permanent',
            'mobile_number' => '0912-345-67890',
            'telephone_number' => '09081003213',
            'email' => '1800700@lnu.edu.ph',
            'birthdate' => Carbon::now(),
            'birthplace' => 'Brgy Mabuhay',
            'religion' => 'Roman Catholic',
            'gender' => 'FEMALE',
            'civil_status' => 'Single'
        ]);

        $student_education_info = StudentEducationInfo::create();
        $student_employee_info = StudentEmployeeInfo::create();

        Student::create([
            'student_account_info_id' => $student_account_info->id,
            'student_basic_info_id' => $student_basic_info->id,
            'student_education_info_id' => $student_education_info->id,
            'student_employee_info_id' => $student_employee_info->id,
            'id_image' => '/alumni/files/images/ids/1800700.png',
            'tor_file' => '/alumni/files/tors/1800700.pdf'

        ]);

    }
}
