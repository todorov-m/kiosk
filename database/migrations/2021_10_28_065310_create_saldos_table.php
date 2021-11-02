<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaldosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saldos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('shiftstart_date')->useCurrent();
            $table->decimal('shiftstart_sum', $precision = 6, $scale = 2)->default('0.00');
            $table->decimal('shiftend_sum', $precision = 6, $scale = 2)->default('0.00');
            $table->decimal('shiftsale_sum', $precision = 6, $scale = 2)->default('0.00');
            $table->dateTime('shiftend_date')->nullable();
            $table->string('shiftstatus')->default('0');
            $table->string('users_id');
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
        Schema::dropIfExists('saldos');
    }
}
