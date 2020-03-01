<?php

use  Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('gender');
            $table->string('role');
            $table->date('birthday')->nullable();
            $table->bigInteger('program_id')->unsigned()->nullable();
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('set null');
            $table->bigInteger('nutrition_id')->unsigned()->nullable();
            $table->foreign('nutrition_id')->references('id')->on('nutrition')->onDelete('set null');
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
