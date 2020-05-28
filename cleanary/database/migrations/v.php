<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaundriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laundries', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id');
            $table->integer('laundryimg');
            $table->integer('tshirt');
            $table->integer('trouser');
            $table->integer('bedshit');
            $table->integer('tie');
            $table->integer('shoes');
            $table->integer('bags');
            $table->integer('towel');
            $table->text('favperfume');
            $table->text('favstarch');
            $table->text('todostarch');
            $table->text('todoperfume');
            $table->text('todoiron');
            $table->string('paymentstatus');
            $table->string('lstatus');
            $table->string('txref');
            $table->string('totalprice');
            $table->string('shortnote');
            $table->string('addr');
            $table->string('country');
            $table->string('state');
            $table->string('localgov');
            $table->string('lat')->nullable();
            $table->string('longi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laundries');
    }
}
