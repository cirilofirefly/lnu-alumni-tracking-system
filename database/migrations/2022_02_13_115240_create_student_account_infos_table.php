<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAccountInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_account_infos', function (Blueprint $table) {
            $table->id();
            $table->string("username")->unique();
            $table->string("password");
            $table->boolean("account_status")->default(false);
            $table->string("educational_attainment");
            $table->string("year_graduate");
            $table->string("college");
            $table->string("program");
            $table->string("degree_level");
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
        Schema::dropIfExists('student_account_infos');
    }
}
