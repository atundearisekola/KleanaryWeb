<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchadminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branchadmins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('branch');
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('addr')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('localgov')->nullable();
            $table->string('lat')->nullable();
            $table->string('longi')->nullable();
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
        Schema::drop('branchadmins');
    }
}
