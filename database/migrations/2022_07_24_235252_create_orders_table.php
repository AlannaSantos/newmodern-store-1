<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //fk user table
            $table->unsignedBigInteger('shipping_division_id'); //fk estado
            $table->unsignedBigInteger('shipping_district_id'); //fk cidade
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('shipping_street');
            $table->string('shipping_number');
            $table->string('shipping_hood');
            $table->integer('postal_code');
            $table->text('notes')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->float('amount', 8, 2);
            $table->string('order_number')->nullable();;
            $table->string('invoice_no')->nullable();
            $table->string('order_date');
            $table->string('order_month');
            $table->string('order_year');
            $table->string('status');
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
        Schema::dropIfExists('orders');
    }
};
