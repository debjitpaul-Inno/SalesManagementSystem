<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_ins', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('voucher_number');
            $table->json('description');
            $table->double('amount');
            $table->date('date');
            $table->enum('status',['PAID', 'UNPAID', 'DUE', 'PENDING'])->default('PENDING');
            $table->foreignId('user_id');
            $table->foreignId('vendor_id');
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
        Schema::dropIfExists('stock_ins');
    }
}
