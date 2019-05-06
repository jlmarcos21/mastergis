<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_sales', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('sale_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->string('course_description', 150);
            $table->decimal('price', 10,2);
            $table->integer('quantity');
            $table->decimal('total', 10,2);
            $table->date('date');

            $table->timestamps();

            //Relacion
            $table->foreign('sale_id')->references('id')->on('sales');
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
        Schema::dropIfExists('detail_sales');
    }
}
