<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('gender')->comment('1 for male 2 for female');
            $table->date('dob');
            $table->string('email');
            $table->string('mobile');
            $table->string('password');
            $table->string('image');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->boolean('status')->default(1)->comment('1 = active , 0 = deactive');
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
        Schema::dropIfExists('user');
    }
}
