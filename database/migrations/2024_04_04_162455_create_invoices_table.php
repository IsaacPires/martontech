<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table)
        {
            $table->id();
            $table->timestamp('ReceivingDate')->nullable();
            $table->timestamp('InvoiceDate')->nullable();
            $table->string('Client', 128)->nullable();
            $table->string('NumberInvoice')->nullable();
            $table->string('Material')->nullable();
            $table->timestamp('DepartureDate')->nullable(); 
            $table->string('NumberInvoiceMarton')->nullable();
            $table->string('FinalTransport')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
