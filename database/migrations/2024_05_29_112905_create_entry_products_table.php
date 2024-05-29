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
            $table->foreignId('products_id')->constrained('products');
            $table->string('SellerName', 128);
            $table->decimal('UnitPrice', 8, 2);
            $table->integer('WithdrawalAmount');
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
        Schema::dropIfExists('entry_products');
    }
}