<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 居住者テーブル
        Schema::create('residents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id');  // 部屋番号ID
            $table->string('name');  // 居住者名
            $table->date('entrance_date');  // 入居日
            $table->date('exit_date'); // 退居日
            $table->string('tel');  // TEL
            $table->string('mail');  // E-mail
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
        Schema::dropIfExists('residents');
    }
}
