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
            $table->date('daily_close_date')->useCurrent();;
            $table->string('daily_close_status');
            $table->string('users_id');
            $table->integer('daily_item_count_7')->default('0');
            $table->integer('daily_item_count_19')->default('0');
            $table->integer('daily_sales_count')->default('0');
            $table->decimal('daily_close_total', $precision = 6, $scale = 2)->default('0.00');
            $table->decimal('daily_close_total_7', $precision = 6, $scale = 2)->default('0.00');
            $table->decimal('daily_close_total_19', $precision = 6, $scale = 2)->default('0.00');
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
