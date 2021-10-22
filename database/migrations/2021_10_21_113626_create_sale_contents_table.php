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
            $table->string('single_price');
            $table->string('linetotal');
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
