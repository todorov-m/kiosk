<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_contents', function (Blueprint $table) {
            $table->id();
            $table->string('sale_heads_id')->index();
            $table->string('items_id')->index();
            $table->string('ean')->index();
            $table->string('name');
            $table->string('tax');
            $table->string('quantity');
            $table->decimal('single_price', $precision = 6, $scale = 2);
            $table->decimal('single_delivery_price', $precision = 6, $scale = 2);
            $table->decimal('linetotal', $precision = 6, $scale = 2);
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
        Schema::dropIfExists('sale_contents');
    }
}
