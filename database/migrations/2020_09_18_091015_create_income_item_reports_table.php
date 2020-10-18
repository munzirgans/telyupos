<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeItemReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_item_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('barcode');
            $table->string('name');
            $table->string('quantity');
            $table->datetime("datetime");
            $table->string('via');
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
        Schema::dropIfExists('income_item_reports');
    }
}
