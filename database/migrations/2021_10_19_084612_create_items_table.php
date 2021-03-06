<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ean');
            $table->decimal('delivery_price', $precision = 6, $scale = 2);
            $table->decimal('sale_price', $precision = 6, $scale = 2);
            $table->string('tax');
            $table->decimal('qty', $precision = 6, $scale = 4)->default('0');
            $table->integer('packing')->default('1');
            $table->string('status')->default('1');
            $table->timestamps();
            $table->index(['ean']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
