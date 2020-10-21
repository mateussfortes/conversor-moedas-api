<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyConvertersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_converters', function (Blueprint $table) {

            $table->id();

            $table->string('currency_value')->nullable();
            $table->string('currency_to')->nullable();
            $table->string('currency_from')->nullable();
            $table->string('currency_converter_value')->nullable();

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
        Schema::dropIfExists('currency_converter');
    }
}
