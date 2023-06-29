<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peramalan_penjualans', function (Blueprint $table) {
            $table->id();
            $table->date('periode');
            $table->integer('data_aktual');
            $table->double('forecasting');
            $table->double('mape');
            $table->double('mad');
            $table->double('mse');
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
        Schema::dropIfExists('peramalan_penjualans');
    }
};
