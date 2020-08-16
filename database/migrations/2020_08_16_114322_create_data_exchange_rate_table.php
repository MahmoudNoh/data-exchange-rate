<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataExchangeRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_exchange_rate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('currency_code', 8)->index();
            $table->date('date');
            $table->double('rate');
            $table->unique(['currency_code', 'date']);
            $table->timestamps(6);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_exchange_rate');
    }
}
