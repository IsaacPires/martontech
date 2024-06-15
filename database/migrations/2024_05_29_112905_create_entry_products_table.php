<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntryProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entry_products', function (Blueprint $table)
        {
            $table->id();
            $table->integer('products_id')->nullable();
            $table->string('SellerName', 128)->nullable();
            $table->integer('Suppliers_id')->nullable();
            $table->string('Brand', 128)->nullable();
            $table->decimal('UnitPrice', 8, 2)->nullable();
            $table->decimal('WithdrawalAmount', 8, 2)->nullable();
            $table->decimal('TotalPrice', 8, 2)->nullable();
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
        Schema::dropIfExists('entry_products');
    }
}
