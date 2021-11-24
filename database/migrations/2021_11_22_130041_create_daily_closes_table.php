<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyClosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_closes', function (Blueprint $table) {
            $table->id();
            $table->date('daily_close_date');
            $table->string('daily_close_status');
            $table->string('users_id');
            $table->decimal('daily_close_total', $precision = 6, $scale = 2)->default('0.00');
            $table->decimal('total_7', $precision = 6, $scale = 2)->default('0.00');
            $table->decimal('total_19', $precision = 6, $scale = 2)->default('0.00');
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
        Schema::dropIfExists('daily_closes');
    }
}
