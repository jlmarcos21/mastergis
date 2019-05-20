<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->increments('id');

            $table->string('code', 100)->unique();
            $table->integer('student_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->boolean('access')->default('0');
            $table->boolean('entry')->default('0');            
            $table->boolean('physical_certificate')->default('0');
            $table->boolean('poll')->default('0');
            $table->boolean('finished')->default('0');
            $table->date('start_date');
            $table->date('final_date');
            $table->integer('remaining_days')->nullable();
            
            $table->timestamps();

            //Relacion
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('course_id')->references('id')->on('courses');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments');
    }
}
