<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_products', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('products_id')->constrained()->onDelete('cascade');
            $table->string('SellerName', 128);
            $table->decimal('WithdrawalAmount', 8, 2);
            $table->string('FabricationOrder');
            $table->string('TypeProduction');
            $table->decimal('UnitPrice', 8, 2);            
            $table->decimal('TotalPrice', 8, 2);
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
        Schema::dropIfExists('_sale_products');
    }
}
