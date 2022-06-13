<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('image')->nullable();
            $table->string('phone_number')->unique();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('nid')->unique();
            $table->double('salary');
            $table->string('blood_group')->nullable();
            $table->date('joining_date');
            $table->json('present_address');
            $table->json('permanent_address');
            $table->string('designation',50)->nullable();
            $table->enum('status',['ACTIVE', 'INACTIVE'])->default('ACTIVE');
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('user_type',['SUPER_ADMIN','ADMIN','STAFF'])->default('STAFF');
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
        Schema::dropIfExists('profiles');
    }
}
