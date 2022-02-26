<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentEducationInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_education_infos', function (Blueprint $table) {
            $table->id();
            $table->string("elem")->nullable();
            $table->string("elem_year")->nullable();
            $table->string("jhs")->nullable();
            $table->string("jhs_year")->nullable();
            $table->string("shs")->nullable();
            $table->string("shs_year")->nullable();
            $table->string("shs_strand")->nullable();
            $table->string("gs")->nullable();
            $table->string("gs_year")->nullable();
            $table->string("gs_course")->nullable();
            $table->string("pgs")->nullable();
            $table->string("pgs_year")->nullable();
            $table->string("pgs_course")->nullable();
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
        Schema::dropIfExists('student_education_infos');
    }
}
