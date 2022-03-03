<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id');
            $table->integer('inventory_id');
            $table->string('description');
            $table->decimal('total_price',18,2)->nullable();
            $table->decimal('unit_price',18,2)->nullable();
            $table->decimal('discount_rate',10,4)->nullable();
            $table->decimal('discount',18,2)->nullable();
            $table->decimal('discounted_amount',18,2)->nullable();
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
        Schema::dropIfExists('customer_items');
    }
}
