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
            $table->integer('sale_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->string('description_sale', 250)->nullable();
            $table->string('description', 250)->nullable();
            $table->boolean('access')->default('0');
            $table->boolean('entry')->default('0');
            $table->boolean('basic_constancy')->default('0');
            $table->boolean('intermediate_constancy')->default('0');
            $table->boolean('advanced_constancy')->default('0');
            $table->boolean('certificate')->default('0');
            $table->boolean('finished')->default('0');            
            $table->boolean('poll')->default('0');
            $table->boolean('physical_certificate')->default('0');
            $table->date('date');
            $table->date('start_date');
            $table->date('final_date');
            $table->integer('remaining_days')->nullable();
            
            $table->timestamps();

            //Relacion
            $table->foreign('sale_id')->references('id')->on('sales');
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
