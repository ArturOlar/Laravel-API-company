<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('houses');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->integer('id_district');
            $table->integer('id_village')->nullable();
            $table->integer('id_street');
            $table->string('house');
            $table->timestamps();
        });
    }
}
