<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->integer('id_district');
            $table->integer('id_village')->nullable();
            $table->integer('id_street');
            $table->integer('id_house');
            $table->integer('id_activity_company');
            $table->string('CEO');
            $table->string('phone_company')->unique();
            $table->string('email_company')->unique();
            $table->integer('quantity_employees');
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
        Schema::dropIfExists('companies');
    }
}
