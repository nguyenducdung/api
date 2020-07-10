<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('time')->comment('thời gian cbi món ăn')->nullable();
            $table->text('info')->comment('thông tin chi tiết')->nullable();
            $table->double('price')->nullable();
            $table->integer('type_id')->comment('mã loại')->nullable();
            $table->integer('status')->nullable();
            $table->integer('num_of_order')->comment('số lượt gọi')->nullable();
            $table->integer('like_of_level')->comment('mức độ yêu thích')->nullable();
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
        Schema::dropIfExists('foods');
    }
}
