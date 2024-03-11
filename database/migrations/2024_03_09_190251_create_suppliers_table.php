<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table)
        {
            $table->id();
            $table->string('Name', 128);
            $table->string('Segments', 128);
            $table->timestamps();
            $table->string('Cnpj', 14);
            $table->string('AddressStreet', 128);
            $table->integer('AddressNumber');
            $table->string('AddressNeighborhood', 128);
            $table->string('AddressCity', 50);
            $table->string('AddressState', 2);
            $table->string('AddressZipCode', 9);
            $table->string('ContactNameOne', 128);
            $table->string('ContactNameTwo');
            $table->integer('ContactPhoneOne');
            $table->integer('ContactPhoneTwo');
            $table->string('ContactEmailOne');
            $table->string('ContactEmailTwo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
