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
            $table->date('ReceivingDate');
            $table->date('InvoiceDate');
            $table->string('Client', 128);
            $table->string('NumberInvoice');
            $table->integer('Material');
            $table->date('DepartureDate');
            $table->string('NumberInvoiceMarton');
            $table->string('FinalTransport');
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
