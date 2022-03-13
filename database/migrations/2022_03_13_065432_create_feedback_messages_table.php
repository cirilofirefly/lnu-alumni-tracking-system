<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback_messages', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->boolean('isAdmin')->default(false);
            $table->unsignedBigInteger('feedback_id');
            $table->foreign('feedback_id')->references('id')->on('feedbacks')->onDelete('cascade');
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
        Schema::dropIfExists('feedback_messages');
    }
}
