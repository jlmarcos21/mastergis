<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('sale_id')->unsigned();
            $table->string('description', 150)->nullable();
            $table->decimal('previous_amount', 10,2);
            $table->decimal('amount', 10,2);
            $table->decimal('next_amount', 10,2);
            $table->date('date');

            $table->timestamps();

            //Relacion
            $table->foreign('sale_id')->references('id')->on('sales');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
