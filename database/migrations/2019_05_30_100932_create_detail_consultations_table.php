<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_consultations', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('consultation_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('contact_id')->unsigned();
            $table->integer('interest_id')->unsigned();
            $table->text('description');
            $table->date('date');

            $table->timestamps();

            //Relacion
            $table->foreign('consultation_id')->references('id')->on('consultations');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('contact_id')->references('id')->on('contacts');
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
        Schema::dropIfExists('detail_consultations');
    }
}
