<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId("student_account_info_id")->constrained();
            $table->foreignId("student_basic_info_id")->constrained();
            $table->foreignId("student_education_info_id")->constrained();
            $table->foreignId("student_employee_info_id")->constrained();
            $table->string("id_image");
            $table->string("tor_file");
            $table->boolean("accept_term")->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('students');
    }
}
