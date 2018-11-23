<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prefix',10);
            $table->string('firstname',255);
            $table->string('lastname',255);
            $table->string('sex',10);
            $table->string('email',255)->nullable();
            $table->string('phonenumber',20)->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTime('created_date')->nullable();
            $table->integer('updated_by')->nullable();
            $table->dateTime('updated_date')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->dateTime('deleted_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
