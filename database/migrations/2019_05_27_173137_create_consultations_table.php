<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('student_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('contact_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->integer('interest_id')->unsigned();
            $table->text('description');            
            $table->date('date');
            $table->date('change_date');
            $table->date('reminder_date');
            $table->boolean('notification')->default('0');
            $table->boolean('finished')->default('0');

            $table->timestamps();

            //Relacion
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('course_id')->references('id')->on('courses'); 
            $table->foreign('interest_id')->references('id')->on('interests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultations');
    }
}
