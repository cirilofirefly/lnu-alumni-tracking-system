<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentBasicInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_basic_infos', function (Blueprint $table) {
            $table->id();
            $table->integer("student_number")->unique();
            $table->string("first_name");
            $table->string("middle_name")->nullable();
            $table->string("last_name");
            $table->string("suffix")->nullable();
            $table->string("current_address");
            $table->string("permanent_address");
            $table->string("mobile_number");
            $table->string("telephone_number");
            $table->string("email");
            $table->dateTime("birthdate");
            $table->string("birthplace");
            $table->string("religion");
            $table->string("gender");
            $table->string("civil_status");
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
        Schema::dropIfExists('student_basic_infos');
    }
}
