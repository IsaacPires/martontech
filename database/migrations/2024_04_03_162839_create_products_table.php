<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table)
        {
            $table->id();
            $table->string('Name', 128);
            $table->decimal('AlertQuantity', 8, 2);
            $table->decimal('StockQuantity', 8, 2)->default(0);
            $table->integer('primary_suppliers_id');//->constrained('suppliers')->onDelete('cascade');
            $table->integer('secondary_supplier_id');//->constrained('suppliers')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
