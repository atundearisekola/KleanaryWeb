<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('laundry');
            $table->string('txref');
            $table->integer('totalnum');
            $table->integer('totalprice');
            $table->integer('worker');
            $table->integer('branch');
            $table->string('lstatus');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pickers');
    }
}
