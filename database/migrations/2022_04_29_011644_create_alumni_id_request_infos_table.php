<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniIdRequestInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_id_request_infos', function (Blueprint $table) {
            $table->id();
            $table->string('student_number');
            $table->string('full_name');
            $table->string('course');
            $table->string('batch');
            $table->string('address');
            $table->string('date_of_birth');
            $table->string('email');
            $table->string('mobile_no');
            $table->string('telephone_no');
            $table->string('signature');
            $table->string('image');
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
        Schema::dropIfExists('alumni_id_request_infos');
    }
}
