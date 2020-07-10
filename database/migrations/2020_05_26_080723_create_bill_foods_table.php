<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_foods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('food_id');
            $table->integer('bill_id');
//            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('bill_foods');
    }
}
