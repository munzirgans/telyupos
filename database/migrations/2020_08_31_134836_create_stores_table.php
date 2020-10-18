<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Store;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->string('postal_code');
            $table->string('description');
            $table->string('photo');
            $table->timestamps();
        });
        Store::create([
            "name"=> "SMKN 10 Jakarta Timur",
            "phone" => "081220304127",
            "address" => "Jl. Smea 6 Mayjend Sutoyo",
            "postal_code" => "13530",
            "description" => "Service Excellent",
            "photo" => "logo-smk10.jpeg"
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
