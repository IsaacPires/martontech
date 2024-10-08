<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->timestamp('Date')->nullable();
            $table->integer('Quantity')->nullable();
            $table->integer('Suppliers_id')->nullable();
            $table->string('Number')->nullable();
            $table->string('State')->nullable();
            $table->string('Owner')->nullable();
            $table->string('Note')->nullable();
            $table->string('Status')->nullable();
            $table->string('Obs')->nullable();
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
        Schema::dropIfExists('tools');
    }
}
