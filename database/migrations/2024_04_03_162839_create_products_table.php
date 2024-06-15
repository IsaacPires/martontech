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
            $table->string('Name', 128)->nullable();
            $table->decimal('AlertQuantity', 8, 2)->nullable();
            $table->decimal('StockQuantity', 8, 2)->nullable()->default(0);
            $table->integer('primary_suppliers_id')->nullable();//->constrained('suppliers')->onDelete('cascade');
            $table->integer('secondary_supplier_id')->nullable();//->constrained('suppliers')->onDelete('cascade');
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
