<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->uuid('uuid');
            $table->foreignId('customer_id')->nullable();
            $table->foreignId('user_id');
            $table->string('order_number', 11);
            $table->json('description');
            $table->double('membership_discount')->nullable();
            $table->double('discount')->nullable();
            $table->double('tax')->nullable();
            $table->double('total');
            $table->double('net_total');
            $table->enum('status',['PENDING','CONFIRMED', 'PROCESSING', 'DELIVERED','PAID', 'UNPAID', 'DUE', 'CANCEL', 'RETURNED'])->default('PENDING');
//            $table->foreignId('payment_type_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
}
