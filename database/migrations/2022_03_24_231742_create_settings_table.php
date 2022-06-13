<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
//            $table->uuid('uuid');
            $table->string('title');
            $table->string('email',100);
            $table->string('mid',20);
            $table->string('phone_number',20);
            $table->json('address');
            $table->string('favicon',100)->nullable();
            $table->string('logo',100)->nullable();
            $table->longText('footer_text')->nullable();

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
        Schema::dropIfExists('settings');
    }
}
