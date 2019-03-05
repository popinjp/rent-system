<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaterBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('water_bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year_month');  // 対象年月(YYYYMM)
            $table->integer('room_id');  // 部屋番号ID
            $table->integer('resident_id');  // 居住者ID
            $table->integer('meterage');  // 月末水道メータ値
            $table->string('meterage_image');  // 月末水道メータ写真
            $table->integer('water_usage');  // 水道使用量
            $table->integer('water_rate');  // 水道料金
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
        Schema::dropIfExists('water_bills');
    }
}
