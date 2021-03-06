<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');

            $table->string('code', 10)->unique();
            $table->string('serie', 6);
            $table->integer('user_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('voucher_id')->unsigned();
            $table->integer('payment_id')->unsigned();
            $table->integer('agency_id')->unsigned()->default('1');            
            $table->integer('currency_id')->unsigned();
            $table->string('description', 250)->nullable();
            $table->date('date');
            $table->time('time');
            $table->boolean('credit')->default('0');
            $table->decimal('subtotal', 10,2);
            $table->decimal('debt', 10,2);
            $table->decimal('total', 10,2);
            $table->decimal('discount_paypal', 10,2);
            $table->decimal('total_paypal', 10,2);
            $table->decimal('discount_interbank', 10,2);
            $table->decimal('total_interbank', 10,2);
            $table->boolean('canceled')->default('0');

            $table->timestamps();

            //Relacion
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('payment_id')->references('id')->on('payment_ms');
            $table->foreign('agency_id')->references('id')->on('agencies');
            $table->foreign('voucher_id')->references('id')->on('vouchers');
            $table->foreign('currency_id')->references('id')->on('currencies');        
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
