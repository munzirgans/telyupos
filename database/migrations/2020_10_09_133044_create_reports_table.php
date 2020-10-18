<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments("id");
            $table->string("id_invoice");
            $table->string("name");
            $table->string("quantity");
            $table->string("price");
            $table->string("discount");
            $table->string("additional_discount");
            $table->string("cash");
            $table->string("change_cash");
            $table->datetime("datetime");
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
        Schema::dropIfExists('reports');
    }
}
