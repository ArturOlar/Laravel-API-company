<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteStreetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('streets');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('streets', function (Blueprint $table) {
            $table->id();
            $table->integer('id_district');
            $table->integer('id_village')->nullable();
            $table->string('street');
            $table->timestamps();
        });
    }
}
