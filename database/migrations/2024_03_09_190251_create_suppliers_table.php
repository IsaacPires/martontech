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
            $table->string('Name', 128)->nullable();
            $table->string('Segments', 128)->nullable();
            $table->timestamps();
            $table->string('Cnpj', 14)->nullable();
            $table->string('AddressStreet', 128)->nullable();
            $table->integer('AddressNumber')->nullable();
            $table->string('AddressNeighborhood', 128)->nullable();
            $table->string('AddressCity', 50)->nullable();
            $table->string('AddressState', 2)->nullable();
            $table->string('AddressZipCode', 9)->nullable();
            $table->string('ContactNameOne', 128)->nullable();
            $table->string('ContactNameTwo')->nullable();
            $table->bigInteger('ContactPhoneOne')->nullable();
            $table->bigInteger('ContactPhoneTwo')->nullable();
            $table->string('ContactEmailOne')->nullable();
            $table->string('ContactEmailTwo')->nullable();
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
