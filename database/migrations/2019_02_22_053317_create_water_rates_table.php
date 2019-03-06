<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaterRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('water_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('year_month');  // 発行年月(YYYYMM)
            $table->string('water_rate_url'); // 水道料金テーブルのURL)
            $table->string('water_rate_data'); // 水道料金データjson形式)
            $table->date('capture_date'); // 水道料金データ取得日時

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
        Schema::dropIfExists('water_rates');
    }
}
