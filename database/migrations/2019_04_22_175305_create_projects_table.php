<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('assignment_id')->unsigned();
            $table->integer('sub_level_id')->unsigned();
            $table->string('description', 150)->nullable();
            $table->boolean('project')->default('0');
            $table->boolean('state')->default('0');
            $table->date('date');

            $table->timestamps();

            //Relaciones
            $table->foreign('assignment_id')->references('id')->on('assignments');
            $table->foreign('sub_level_id')->references('id')->on('sub_levels');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
