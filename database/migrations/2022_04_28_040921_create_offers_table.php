<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name');
            $table->enum('type', ['FLAT', 'BUY_GET', 'PRODUCT_WISE','PAYMENT_TYPE','ORDER_AMOUNT'])->default('PRODUCT_WISE');
            $table->enum('offer_on', ['PERCENTAGE','AMOUNT'])->default('PERCENTAGE');
            $table->integer('percentage')->nullable();
            $table->double('amount')->nullable();
            $table->longText('description')->nullable();
            $table->enum('status', ['AVAILABLE','NOT_AVAILABLE'])->default('NOT_AVAILABLE');
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('payment_type_id')->nullable();
            $table->integer('buy_quantity')->nullable();
            $table->integer('get_quantity')->nullable();
            $table->double('order_amount')->nullable();
            $table->double('discount_limit')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('offers');
    }
}
