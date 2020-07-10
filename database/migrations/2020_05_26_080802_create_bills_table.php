<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->integer('voucher_id')->nullable();
            $table->integer('table_id')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('num_of_food')->comment('số lượng món đã gọi')->nullable();
            $table->string('price_total')->comment('tổng tiền của món ăn')->nullable();
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
        Schema::dropIfExists('bills');
    }
}
