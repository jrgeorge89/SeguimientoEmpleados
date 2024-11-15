<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('id');
            $table->string('name', 50);
            $table->string('email', 60);
            $table->string('area', 30);
            $table->unsignedBigInteger('categorie_id');
            $table->string('companie', 30);
            $table->text('url_logo', 255);
            $table->integer('satisfaction');
            $table->boolean('favorite');
            $table->timestamps();

            $table->foreign('categorie_id')->references('id')->on('categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
