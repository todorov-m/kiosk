<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_heads', function (Blueprint $table) {
            $table->id();
            $table->string('users_id');
            $table->decimal('total', $precision = 6, $scale = 2)->default('0');
            $table->string('status')->default('0');
            $table->string('salesId')->default('0');
            $table->decimal('payd', $precision = 6, $scale = 2)->default('0');
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
        Schema::dropIfExists('sale_heads');
    }
}
