<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('title',50);
            $table->double('quantity')->default(0);
            $table->longText('description')->nullable();
            $table->double('price');
            $table->string('unit',15);
            $table->string('model',20)->nullable();
            $table->string('brand',20)->nullable();
            $table->string('color',20)->nullable();
            $table->string('image',100)->nullable();
            $table->string('barcode_number',100)->nullable();
            $table->enum('status',['AVAILABLE', 'NOT_AVAILABLE'])->default('AVAILABLE');

            $table->foreignId('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('products');
    }
}
