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
            $table->string('sale_heads_id');
            $table->string('items_id');
            $table->string('ean');
            $table->string('name');
            $table->string('tax');
            $table->string('quantity');
            $table->integer('packing');
            $table->decimal('single_price', $precision = 6, $scale = 2);
            $table->decimal('single_delivery_price', $precision = 6, $scale = 2);
            $table->decimal('linetotal', $precision = 6, $scale = 2);
            $table->timestamps();
            $table->index(['sale_heads_id', 'items_id','ean']);
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
