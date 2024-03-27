<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoituresTable extends Migration
{
    public function up()
    {
        Schema::create('voitures', function (Blueprint $table) {
            $table->id();
            $table->string('marque')->nullable();
            $table->string('modele')->nullable();
            $table->integer('annee')->nullable();
            $table->integer('kilometrage')->nullable();
            $table->decimal('prix', 10, 2)->nullable();
            $table->integer('puissance')->nullable();
            $table->string('motorisation')->nullable();
            $table->string('carburant')->nullable();
            $table->text('options')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
