<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Users;

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
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->text('address');
            $table->string('phone');
            $table->string('level');
            $table->timestamps();
        });
        Users::create([
            "name" => "Muhammad Munzir",
            "email" => "munzirmz36@gmail.com",
            "password" => "munzirdev",
            "address" => "Jl. Pucung 3",
            "phone" => "081220304127",
            "level" => "Admin"
        ]);
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
