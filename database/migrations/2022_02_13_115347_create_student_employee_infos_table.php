<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentEmployeeInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_employee_infos', function (Blueprint $table) {
            $table->id();
            $table->string("company")->nullable();
            $table->string("designation")->nullable();
            $table->string("address")->nullable();
            $table->string("tel_no")->nullable();
            $table->string("mobile_no")->nullable();
            $table->string("email")->nullable();
            $table->string("sp_name")->nullable();
            $table->string("sp_occupation")->nullable();
            $table->string("sp_mobile_no")->nullable();
            $table->string("sp_company")->nullable();
            $table->string("sp_position")->nullable();
            $table->string("sp_buss_address")->nullable();
            $table->string("sp_fax_no")->nullable();
            $table->string("sp_email")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_employee_infos');
    }
}
