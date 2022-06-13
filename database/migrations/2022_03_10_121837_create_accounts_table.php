<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('account_name',50);
            $table->enum('type',['DEBIT','CREDIT']);
            $table->string('reference_number',20);
            $table->longText('description')->nullable();
            $table->enum('status', ['PAID', 'UNPAID', 'DUE'])->default('UNPAID');
            $table->date('date');
            $table->double('tax')->default(0);
            $table->double('discount')->default(0);
            $table->double('total');
            $table->double('net_total');
            $table->double('due')->default(0);
            $table->double('membership_discount')->default(0);
            $table->string('pay_to',50);
            $table->date('due_payment_date')->nullable();
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
        Schema::dropIfExists('accounts');
    }
}
