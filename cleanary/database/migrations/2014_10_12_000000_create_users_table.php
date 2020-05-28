<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname');
            $table->string('lname');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('provider');
            $table->string('provider_id');
            $table->string('gender')->nullable();
            $table->json('favstarch')->nullable();
            $table->json('favperf')->nullable();
            $table->string('phone')->nullable();
            $table->string('addr')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('localgov')->nullable();
            $table->string('lat')->nullable();
            $table->string('longi')->nullable();
            $table->string('picurl')->nullable();
             $table->integer('role')->default(2);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
