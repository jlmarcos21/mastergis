<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');

            $table->string('code', 10)->unique()->nullable();
            $table->string('name', 150)->unique();
            $table->string('lastname', 150)->unique();            
            $table->enum('nationality', ['EXTRANJERO', 'NACIONAL'])->default('NACIONAL');
            $table->integer('country_id')->unsigned();            
            $table->string('email', 240)->unique();
            $table->string('phone', 25)->nullable();
            $table->boolean('state', 25)->default('1')->nullable();

            $table->timestamps();

            //Relacion
            $table->foreign('country_id')->references('id')->on('countries');

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
